<?php

namespace Aboldyrev;


use Carbon\Carbon;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Класс для работы с кешем
 *
 * @package Aboldyrev
 */
class Cache
{
	/**
	 * Директория для работы с кешем
	 *
	 * @var string $folder
	 */
	protected $folder;

	/**
	 * Объект файловой системы
	 *
	 * @var Filesystem $filesystem
	 */
	protected $filesystem;


	public function __construct(string $defaultFolder) {
		$this->folder = $defaultFolder;
		$this->filesystem = new Filesystem();
	}


	/**
	 * Проверяет пустой ли кеш
	 *
	 * @return bool
	 */
	public function isEmptyCache():bool {
		return !$this->filesystem->exists($this->folder) || scandir($this->folder) <= 2;
	}


	/**
	 * Проверяет mime-type закешированного файла
	 *
	 * @param string $url
	 * @param string $type
	 *
	 * @return bool
	 */
	public function checkMimeType(string $url, string $type):bool {
		$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->getPath($url));

		if ($mime == $type) {
			return true;
		}

		$exploded_mime = explode('/', $mime);
		$exploded_type = explode('/', $type);

		return count($exploded_type) == 2 &&
			$exploded_type[ 1 ] == '*' &&
			$exploded_type[ 0 ] == $exploded_mime[ 0 ];
	}


	/**
	 * Метод для проверки устарел ли кеш файла или нет
	 *
	 * @param string      $url
	 * @param Carbon|null $date по умолчанию текущая дата
	 * @param int         $diffInHours
	 * @param bool        $abs  флаг указывающий сравнивать абсолютные значения
	 *
	 * @return bool
	 */
	public function checkDate(string $url, Carbon $date = NULL, int $diffInHours = 1, bool $abs = true):bool {
		if (is_null($date)) {
			$date = Carbon::now();
		}

		if ($this->filesystem->exists($this->getPath($url))) {
			$file_date = filemtime($this->getPath($url));
			$timestamp = Carbon::createFromTimestamp($file_date);

			return $timestamp->diffInHours($date, $abs) <= $diffInHours;
		} else {
			return false;
		}

	}


	/**
	 * Проверяет существует ли кеш определенного запроса
	 *
	 * @param string $url
	 *
	 * @return bool
	 */
	public function check(string $url):bool {
		return $this->filesystem->exists($this->getPath($url));
	}


	/**
	 * Возвращает содержимое кеша
	 *
	 * @param string $url
	 *
	 * @return string|null
	 */
	public function get(string $url) {
		if ($this->check($url)) {
			return file_get_contents($this->getPath($url));
		} else {
			return NULL;
		}
	}


	/**
	 * Кеширует данные
	 *
	 * @param string $url
	 * @param        $data
	 *
	 * @return void
	 */
	public function put(string $url, $data):void {
		$path = $this->getPath($url);
		$this->filesystem->dumpFile($path, $data);
	}


	/**
	 * Сохраняет или возвращает кешированные данные
	 *
	 * @param string     $url
	 * @param null|mixed $data
	 *
	 * @return mixed|null
	 */
	public function cache(string $url, $data = NULL) {
		if (!is_null($data)) {
			$this->put($url, $data);
		}

		return $this->get($url);
	}


	/**
	 * Удаляет из кеша файл, папку или полностью весь кеш
	 *
	 * @param string|NULL $url
	 *
	 * @return void
	 */
	public function forget(string $url = NULL):void {
		$path = $this->folder;

		if (is_null($url)) {
			$this->filesystem->remove($path);
		} else {
			$host = $this->getSiteName($url);

			if ($url == $host) {
				$path = $this->getPath($url, true);
			} elseif (!is_null($url)) {
				$path = $this->getPath($url);
			}

			$this->filesystem->remove($path);
		}
	}


	/**
	 * Возвращает путь до файла на основе URL
	 *
	 * @param string $url
	 * @param bool   $root
	 *
	 * @return string
	 */
	public function getPath(string $url, bool $root = false):string {
		$host = $this->getSiteName($url);
		$path = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_DIRNAME);

		if ($host == $path) {
			$path = '/';
		}

		if ($root) {
			return $this->folder . '/' . $host;
		}

		if (mb_substr($path, 0, 1) != '/') {
			$path = '/' . $path;
		}

		if (mb_substr($path, -1) != '/') {
			$path .= '/';
		}

		return $this->folder . '/' . $host . $path . $this->getFilename($url);
	}


	/**
	 * Возвращает название сайта (домен)
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	protected function getSiteName(string $url):string {
		return $this->getHost($url);
	}


	/**
	 * Получить хост из URL
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	protected function getHost(string $url):string {
		$pattern = '/^(?:https?:\/\/)?([^\/\n\r]+)/ui';
		preg_match($pattern, $url, $matches);

		return $matches[ 1 ];
	}


	/**
	 * Возвращает название файла на основе URL
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	protected function getFilename(string $url):string {
		$extension = pathinfo($url, PATHINFO_EXTENSION);

		if (mb_strlen($extension)) {
			$filename = pathinfo($url, PATHINFO_FILENAME) . '.' . $extension;
		} else {
			$filename = hash('sha1', $url) . '_' . hash('md5', $url);
		}

		return $filename;
	}
}