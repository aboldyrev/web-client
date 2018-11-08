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
	 * @var string $proxy
	 */
	protected $proxy;

	/**
	 * Порт
	 *
	 * @var string|null $port
	 */
	protected $port = NULL;

	/**
	 * Пользователь
	 *
	 * @var string|null $username
	 */
	protected $username = NULL;

	/**
	 * Пароль
	 *
	 * @var string|null $password
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
	 * @return void
	 */
	protected function setAccount(string $userPass, string $user = NULL, string $password = NULL):void {
		$this->username = $userPass;

		if (mb_stripos($userPass, ':')) {
			list($this->username, $this->password) = explode(':', $userPass);
		}

		if (!is_null($user)) {
			$this->username = $user;
		}

		if (!is_null($password)) {
			$this->password = $password;
		}
	}


	/**
	 * Разбивает строку с хостом и портом на строку
	 *
	 * @param string      $hostPort
	 * @param string|NULL $port
	 *
	 * @return void
	 */
	protected function setAddress(string $hostPort, string $port = NULL):void {
		if (mb_stripos($hostPort, ':')) {
			list($this->proxy, $this->port) = explode(':', $hostPort);
		}

		if ($port) {
			$this->port = $port;
		}
	}


	private function __construct(string $proxy, string $port = NULL, string $username = NULL, string $password = NULL) {
		$this->proxy = $proxy;

		if (mb_stripos($proxy, '@') !== false) {
			list($user_pass, $this->proxy) = explode('@', $proxy);
		}

		if (!is_null($username)) {
			$user_pass = $username;
		}

		if (isset($user_pass)) {
			$this->setAccount($user_pass, $username, $password);
		}

		$this->setAddress($this->proxy, $port);
	}
}