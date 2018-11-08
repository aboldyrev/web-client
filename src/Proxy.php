<?php

namespace Aboldyrev;

/**
 * Класс прокси
 *
 * @package Aboldyrev
 */
class Proxy
{
	/**
	 * Хост
	 *
	 * @var string
	 */
	protected $proxy;

	/**
	 * Порт
	 *
	 * @var string|null
	 */
	protected $port = NULL;

	/**
	 * Пользователь
	 *
	 * @var string|null
	 */
	protected $username = NULL;

	/**
	 * Пароль
	 *
	 * @var string|null
	 */
	protected $password = NULL;


	/**
	 * Создание объекта прокси
	 *
	 * @param string      $proxy
	 * @param string|NULL $port
	 * @param string|NULL $username
	 * @param string|NULL $password
	 *
	 * @return Proxy
	 */
	public static function create(string $proxy, string $port = NULL, string $username = NULL, string $password = NULL):self {
		return new static($proxy, $port, $username, $password);
	}


	/**
	 * Получить прокси в виде строки
	 *
	 * @return string
	 */
	public function get():string {
		$result = $this->proxy;

		if ($this->port) {
			$result .= ':' . $this->port;
		}

		if ($this->username && $this->password) {
			return $this->username . ':' . $this->password . '@' . $result;
		}

		return $result;
	}


	/**
	 * Разбивает строку с логином и паролем в массив
	 *
	 * @param string      $userPass
	 * @param string|NULL $user
	 * @param string|NULL $password
	 *
	 * @return array
	 */
	protected function prepareAccount(string $userPass, string $user = NULL, string $password = NULL):array {
		$default_user = NULL;
		$default_pass = NULL;

		if (mb_stripos($userPass, ':')) {
			list($default_user, $default_pass) = explode(':', $userPass);
		}

		return [
			$user ?: $default_user,
			$password ?: $default_pass,
		];
	}


	/**
	 * Разбивает строку с хостом и портом на строку
	 *
	 * @param string      $hostPort
	 * @param string|NULL $port
	 *
	 * @return array
	 */
	protected function prepareAddress(string $hostPort, string $port = NULL):array {
		$default_host = NULL;
		$default_port = NULL;

		if (mb_stripos($hostPort, ':')) {
			list($default_host, $default_port) = explode(':', $hostPort);
		}

		return [
			$hostPort ?: $default_host,
			$port ?: $default_port,
		];
	}


	private function __construct(string $proxy, string $port = NULL, string $username = NULL, string $password = NULL) {
		$this->proxy = $proxy;

		if (mb_stripos($proxy, '@') !== false) {
			list($user_pass, $this->proxy) = explode('@', $proxy);
			list($this->username, $this->password) = $this->prepareAccount($user_pass, $username, $password);
		}

		list($this->proxy, $this->port) = $this->prepareAddress($this->proxy, $port);
	}
}