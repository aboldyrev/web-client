<?php

namespace Aboldyrev;


use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;


/**
 * Класс клиента
 *
 * @package Aboldyrev
 */
class WebClient
{
	/**
	 * Объект клиента
	 *
	 * @var Client $client
	 */
	protected $client;

	/**
	 * Объект кеша
	 *
	 * @var Cache $cache
	 */
	protected $cache;

	/**
	 * Время ожидания ответа
	 *
	 * @var int $timeout
	 */
	protected $timeout = 120;

	/**
	 * Количество попыток
	 *
	 * @var int $try
	 */
	protected $try = 3;

	/**
	 * Флаг использования прокси
	 *
	 * @var bool $useProxy
	 */
	protected $useProxy = false;

	/**
	 * Список доступных прокси
	 *
	 * @var Proxy[]
	 */
	protected $proxies = [];

	/**
	 * Список доступных user-agent'ов
	 *
	 * @var array
	 */
	protected $userAgents = [
		'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
	];

	/**
	 * Флаг использования задержки перед запросом
	 *
	 * @var bool $useWait
	 */
	protected $useWait = true;

	/**
	 * Последнее значение времени задержки перед запросом
	 *
	 * @var null|float $wait
	 */
	protected $wait = NULL;

	/**
	 * Последняя использованная ссылка
	 *
	 * @var string $url
	 */
	protected $url;

	/**
	 * Последний использованный метод
	 *
	 * @var string $method
	 */
	protected $method = 'GET';

	/**
	 * Последний использованный список параметров
	 *
	 * @var array $params
	 */
	protected $params = [];

	/**
	 * Последний использованный прокси
	 *
	 * @var null|string $proxy
	 */
	protected $proxy = NULL;

	/**
	 * Последний использованный user-agent
	 *
	 * @var null|string $userAgent
	 */
	protected $userAgent = NULL;

	/**
	 * Время последнего запроса
	 *
	 * @var Carbon $lastRequestTime
	 */
	protected $lastRequestTime;

	/**
	 * Флаг работы кеша
	 *
	 * @var bool $useCache
	 */
	protected $useCache = true;


	/**
	 * Создание объекта клиента
	 *
	 * @param string $cacheFolder директория для хранения кеша
	 * @param Client $client
	 *
	 * @return WebClient
	 */
	public static function create(string $cacheFolder, Client $client = NULL):self {
		return new static($cacheFolder, $client);
	}


	/**
	 * Устанавливает время ожидания ответа
	 *
	 * @param int $timeout
	 *
	 * @return WebClient
	 */
	public function setTimeout(int $timeout):self {
		$this->timeout = $timeout;

		return $this;
	}


	/**
	 * Устанавливает количество попыток отправки запроса
	 *
	 * @param int $try
	 *
	 * @return WebClient
	 */
	public function setTry(int $try):self {
		$this->try = $try;

		return $this;
	}


	/**
	 * Устанавливает флаг использования прокси
	 *
	 * @param bool $use
	 *
	 * @return WebClient
	 */
	public function setUseProxy(bool $use):self {
		$this->useProxy = $use;

		return $this;
	}


	/**
	 * Обновляет список прокси
	 *
	 * @param string|array $proxies
	 * @param string|NULL  $port
	 * @param string|NULL  $username
	 * @param string|NULL  $password
	 *
	 * @return WebClient
	 */
	public function setProxies($proxies, string $port = NULL, string $username = NULL, string $password = NULL):self {
		if (is_string($proxies)) {
			$proxies = explode(PHP_EOL, $proxies);
		}

		if (is_array($proxies)) {
			$this->proxies = [];

			foreach ($proxies as $proxy) {
				if (mb_strlen($proxy)) {
					$this->proxies[] = Proxy::create($proxy, $port, $username, $password);
				}
			}
		}

		return $this;
	}


	/**
	 * Обновляет список user-agent'ов
	 *
	 * @param array|string|null $userAgents
	 *
	 * @return WebClient
	 */
	public function setUserAgents($userAgents = NULL):self {
		if (is_null($userAgents)) {
			$userAgents = file_get_contents(__DIR__ . '/../useragents.txt');
		}

		if (is_string($userAgents)) {
			$userAgents = explode(PHP_EOL, $userAgents);
		}

		if (is_array($userAgents) && count($userAgents)) {
			$this->userAgents = array_diff($userAgents, [ '' ]);
		}

		return $this;
	}


	/**
	 * Устанавливает флаг использования задержки перед запросом
	 *
	 * @param bool $use
	 *
	 * @return WebClient
	 */
	public function setUseWait(bool $use):self {
		$this->useWait = $use;

		return $this;
	}


	/**
	 * Устанавливает время задержки перед запросом
	 *
	 * @param float|NULL $wait
	 *
	 * @return WebClient
	 */
	public function setWait(float $wait = NULL):self {
		if (is_null($wait)) {
			$wait = rand(500, 5000) / 1000;
		}

		$this->useWait = true;
		$this->wait = $wait;

		return $this;
	}


	/**
	 * Установка метода запроса
	 *
	 * @param string $method
	 *
	 * @return WebClient
	 */
	public function setMethod(string $method):self {
		$this->method = strtoupper($method);

		return $this;
	}


	/**
	 * Установка параметров запроса
	 *
	 * @param array $params
	 *
	 * @return WebClient
	 */
	public function setParams(array $params = []):self {
		$this->params = $params;

		return $this;
	}


	public function setUseCache(bool $use):self {
		$this->useCache = $use;

		return $this;
	}


	/**
	 * Обновляет текущий прокси
	 *
	 * @return WebClient
	 */
	public function updateProxy():self {
		if ($this->useProxy) {
			$this->proxy = $this->getProxy();
		}

		return $this;
	}


	/**
	 * Обновляет текущий user-agent
	 *
	 * @return WebClient
	 */
	public function updateUserAgent():self {
		$this->userAgent = $this->getUserAgent();

		return $this;
	}


	/**
	 * Возвращает объект кеша
	 *
	 * @return Cache
	 */
	public function getCache():Cache {
		return $this->cache;
	}


	/**
	 * Получить содержимое URL
	 *
	 * @param string      $url
	 * @param string|NULL $mimeType
	 *
	 * @return null|string
	 */
	public function getContent(string $url, string $mimeType = NULL) {

		if ($this->useCache && $this->cache->check($url)) {
			return $this->cache->get($url);
		} else {
			$response = $this->sendRequest($url);

			if (is_null($response) || mb_strlen($response) === 0) {
				return NULL;
			}

			$this->cache->put($url, $response);

			if (!is_null($mimeType) && !$this->cache->checkMimeType($url, $mimeType)) {
				return NULL;
			}

			return is_string($response) && mb_strlen($response) ? $response : NULL;
		}

	}


	/**
	 * Скачивание списка файлов
	 *
	 * @param array  $links
	 * @param string $folder
	 * @param bool   $useCache
	 * @param bool   $toString
	 *
	 * @return array|string
	 */
	public function getFiles(array $links, string $folder, bool $useCache = false, bool $toString = false) {
		$result = [];

		foreach ($links as $link) {
			$result[] = $this->getFile($link, $folder, $useCache);
		}

		return $toString ? implode(',', $result) : $result;
	}


	/**
	 * Скачивание файла
	 *
	 * @param string $link
	 * @param string $folder
	 * @param bool   $useCache флаг указывающий использовать ли кеширование
	 *
	 * @return string
	 */
	public function getFile(string $link, string $folder, bool $useCache = false):string {
		$filename = basename($link);

		if (mb_substr($folder, -1) == '/') {
			$path = $folder . $filename;
		} else {
			$path = $folder . '/' . $filename;
		}

		if ($useCache && $this->cache->check($link)) {
			return $this->cache->getPath($link);
		}

		if (!file_exists($path)) {
			$file = $this
				->setMethod('get')
				->sendRequest($link);

			exec('mkdir -p ' . $folder);
			file_put_contents($path, $file);

			if ($useCache) {
				$this->cache->put($link, $file);
			}
		}

		return $path;
	}


	protected function __construct(string $cacheFolder, Client $client = NULL) {
		$this->cache = new Cache($cacheFolder);

		if (isset($client)) {
			$this->client = $client;
		}
	}


	/**
	 * Возвращает случайный прокси из списка доступных
	 *
	 * @param bool $asObject флаг, указывающий возвращать прокси в виде объекта
	 *
	 * @return string|Proxy|null
	 */
	protected function getProxy(bool $asObject = false) {
		if (count($this->proxies)) {
			$key = array_rand($this->proxies);
			$proxy = $this->proxies[ $key ];

			return $asObject ? $proxy : $proxy->get();
		}

		return NULL;
	}


	/**
	 * Возвращает случайный user-agent из списка доступных. Нужно для имитации живых запросов и снижения вероятности блокировки
	 *
	 * @return string
	 */
	protected function getUserAgent():string {
		$key = array_rand($this->userAgents);

		return $this->userAgents[ $key ];
	}


	protected function sendRequest(string $url) {
		if (is_null($this->client)) {
			$client = new Client();
		} else {
			$client = clone $this->client;
		}

		if (is_null($this->userAgent)) {
			$this->updateUserAgent();
		}

		$options = [
			RequestOptions::ALLOW_REDIRECTS => true,
			RequestOptions::CONNECT_TIMEOUT => $this->timeout,
			RequestOptions::HEADERS         => [
				'User-Agent' => $this->userAgent,
			],
		];

		for ($try = 1; $try <= $this->try; $try++) {
			if ($this->useProxy && is_null($this->proxy)) {
				$this->updateProxy();
			}

			$this->updateProxy();

			if (count($this->params)) {
				$options[ RequestOptions::FORM_PARAMS ] = $this->params;
			}

			if ($this->useProxy && $this->proxy) {
				$options[ RequestOptions::PROXY ] = $this->proxy;
			}

			$this->wait();

			$request = new Request($this->method, $url);
			$response = $client->send($request, $options);

			$this->lastRequestTime = Carbon::now();
			$this->updateUserAgent();
			$this->updateProxy();

			if ($response->getStatusCode() < 300) {
				return $response->getBody()->getContents();
			}
		}

		return NULL;
	}


	/**
	 * Ставит задержку перед отправкой запроса если это настроили. Необходимо для имитации реальных запросов.
	 *
	 * @return WebClient
	 */
	protected function wait():self {

		if (is_null($this->lastRequestTime)) {
			$this->lastRequestTime = Carbon::now();

			return $this;
		}

		if ($this->lastRequestTime->diffInSeconds() == 0) {
			sleep(1);
		}

		if ($this->useWait && is_null($this->wait)) {
			usleep(rand(500, 5000) * 1000);
		} elseif ($this->useWait) {
			usleep($this->wait * 1000 * 1000);
		}

		return $this;

	}
}