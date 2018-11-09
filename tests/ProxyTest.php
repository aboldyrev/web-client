<?php

use Aboldyrev\Proxy;
use PHPUnit\Framework\TestCase;

class ProxyTest extends TestCase
{
	private $host = 'google.com';

	private $port = '8080';

	private $user = 'admin';

	private $password = '0000';


	public function testCreate() {
		$proxy = Proxy::create('');

		$this->assertInstanceOf(Proxy::class, $proxy);
	}


	public function testHostParsing() {
		$proxy = Proxy::create($this->host);
		$this->assertAttributeEquals($this->host, 'proxy', $proxy);
		$this->assertAttributeEmpty('port', $proxy);
		$this->assertAttributeEmpty('username', $proxy);
		$this->assertAttributeEmpty('password', $proxy);
	}


	public function testPortParsing() {
		$proxy = Proxy::create($this->getHostPort());

		$this->assertAttributeEquals($this->port, 'port', $proxy);
		$this->assertAttributeEmpty('username', $proxy);
		$this->assertAttributeEmpty('password', $proxy);

		$proxy = Proxy::create($this->host, $this->port);

		$this->assertAttributeEquals($this->port, 'port', $proxy);
		$this->assertAttributeEmpty('username', $proxy);
		$this->assertAttributeEmpty('password', $proxy);
	}


	public function testUserParsing() {
		$proxy = Proxy::create($this->getFullProxy(true));

		$this->assertAttributeEquals($this->user, 'username', $proxy);
		$this->assertAttributeEmpty('password', $proxy);

		$proxy = Proxy::create($this->host, $this->port, $this->user);

		$this->assertAttributeEquals($this->user, 'username', $proxy);
		$this->assertAttributeEmpty('password', $proxy);

	}


	public function testPasswordParsing() {

		$proxy = Proxy::create($this->getFullProxy(true, true));
		$this->assertAttributeEquals($this->password, 'password', $proxy);

		$proxy = Proxy::create($this->host, $this->port, $this->user, $this->password);
		$this->assertAttributeEquals($this->password, 'password', $proxy);

	}


	public function testGetProxy() {
		$proxy = Proxy::create($this->host);
		$this->assertEquals($this->host, $proxy->get());

		$proxy = Proxy::create($this->getFullProxy(true, true));
		$this->assertEquals($this->getFullProxy(true, true), $proxy->get());
	}


	protected function getHostPort() {
		return $this->host . ':' . $this->port;
	}


	protected function getUserPass() {
		return $this->user . ':' . $this->password;
	}


	protected function getFullProxy(bool $usePort = false, bool $usePassword = false) {
		$host = $usePort ? $this->getHostPort() : $this->host;
		$user = $usePassword ? $this->getUserPass() : $this->user;

		return $user . '@' . $host;
	}

}
