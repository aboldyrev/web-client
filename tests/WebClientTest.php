<?php

use Aboldyrev\Cache;
use Aboldyrev\Proxy;
use Aboldyrev\WebClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class WebClientTest extends TestCase
{
	/**
	 * @var WebClient $client
	 */
	protected $client;

	protected $cacheFolder = __DIR__ . '/cache';


	protected function setUp() {
		parent::setUp();

		$mock = new MockHandler([
			// Запросы для тестирования getContent
			new Response(200, [ 'Content-Type' => 'text/plain' ], 'test'),
			new Response(200, [], 'test content'),
			new Response(200),

			// Запросы для тестирования getFile
			new Response(200),

			// Запросы для тестирования getFiles
			new Response(200),
			new Response(200),
			new Response(200),
			new Response(200),
			new Response(200),
			new Response(200),
		]);

		$handler = HandlerStack::create($mock);
		$client = new Client([ 'handler' => $handler ]);
		$this->client = WebClient::create(__DIR__ . '/cache', $client)->setUseWait(false);
	}


	protected function tearDown() {
		parent::tearDown();

		$this->client->getCache()->forget();
		exec('rm -rf ' . __DIR__ . '/files');
	}


	public function testCreate() {
		$this->assertInstanceOf(
			WebClient::class,
			WebClient::create(__DIR__ . '/cache')
		);
	}


	public function testSetTimeout() {
		$this->assertAttributeEquals(120, 'timeout', $this->client);

		$this->client->setTimeout(30);
		$this->assertAttributeEquals(30, 'timeout', $this->client);

		$this->assertInstanceOf(WebClient::class, $this->client->setTimeout(30));
	}


	public function testSetTry() {
		$this->assertAttributeEquals(3, 'try', $this->client);

		$this->client->setTry(1);
		$this->assertAttributeEquals(1, 'try', $this->client);

		$this->assertInstanceOf(WebClient::class, $this->client->setTry(1));
	}


	public function testSetUseProxy() {
		$this->assertAttributeEquals(false, 'useProxy', $this->client);

		$this->client->setUseProxy(true);
		$this->assertAttributeEquals(true, 'useProxy', $this->client);

		$this->assertInstanceOf(WebClient::class, $this->client->setUseProxy(true));
	}


	public function testSetProxies() {
		$this->assertAttributeEquals([], 'proxies', $this->client);

		$proxies = [
			[
				'test.ru',
				'test.ru:8080',
				'admin@test.ru',
				'admin:0000@test.ru:8080',
			],
			[
				Proxy::create('test.ru'),
				Proxy::create('test.ru:8080'),
				Proxy::create('admin@test.ru'),
				Proxy::create('admin:0000@test.ru:8080'),
			],
		];
		$client = WebClient::create($this->cacheFolder)->setProxies($proxies[ 0 ]);
		$this->assertAttributeEquals($proxies[ 1 ], 'proxies', $client);

		$proxies = [
			'test1.ru' . PHP_EOL .
			'test1.ru:8080' . PHP_EOL .
			'admin@test1.ru' . PHP_EOL .
			'admin:0000@test1.ru:8080' . PHP_EOL,
			[
				Proxy::create('test1.ru'),
				Proxy::create('test1.ru:8080'),
				Proxy::create('admin@test1.ru'),
				Proxy::create('admin:0000@test1.ru:8080'),
			],
		];
		$client = WebClient::create($this->cacheFolder)->setProxies($proxies[ 0 ]);
		$this->assertAttributeEquals($proxies[ 1 ], 'proxies', $client);

		$this->assertInstanceOf(WebClient::class, $client->setProxies($proxies[ 0 ]));
	}


	public function testSetUserAgents() {
		$this->assertAttributeCount(1, 'userAgents', $this->client);

		$this->client->setUserAgents();
		$this->assertAttributeEquals(
			explode(PHP_EOL, file_get_contents(__DIR__ . '/../useragents.txt')),
			'userAgents',
			$this->client
		);

		$userAgents = 'Mozilla1' . PHP_EOL .
			'Mozilla2' . PHP_EOL .
			'Mozilla3' . PHP_EOL .
			'Mozilla4' . PHP_EOL;
		$client = WebClient::create($this->cacheFolder)->setUserAgents($userAgents);
		$this->assertAttributeEquals(array_diff(explode(PHP_EOL, $userAgents), [ '' ]), 'userAgents', $client);

		$this->assertInstanceOf(WebClient::class, $this->client->setUserAgents());
	}


	public function testSetUseWait() {
		$this->assertAttributeEquals(false, 'useWait', $this->client);

		$this->client->setUseWait(true);
		$this->assertAttributeEquals(true, 'useWait', $this->client);

		$this->assertInstanceOf(WebClient::class, $this->client->setUseWait(true));
	}


	public function testSetWait() {
		$this->assertAttributeEmpty('wait', $this->client);

		$this->client->setWait();
		$this->assertAttributeNotEmpty('wait', $this->client);

		$this->client->setWait(15);
		$this->assertAttributeEquals(15, 'wait', $this->client);

		$this->assertInstanceOf(WebClient::class, $this->client->setWait());
	}


	public function testSetMethod() {
		$this->assertAttributeEquals('GET', 'method', $this->client);

		$this->client->setMethod('post');
		$this->assertAttributeEquals('POST', 'method', $this->client);
	}


	public function testSetParams() {
		$this->assertAttributeEquals([], 'params', $this->client);

		$this->client->setParams([ 'q' => 'test' ]);
		$this->assertAttributeEquals([ 'q' => 'test' ], 'params', $this->client);
	}


	public function testUpdateProxy() {
		$this->assertAttributeEmpty('proxy', $this->client);

		$this->client->setUseProxy(true)->updateProxy();
		$this->assertAttributeEmpty('proxy', $this->client);

		$this
			->client
			->setProxies('test.ru')
			->updateProxy();
		$this->assertAttributeNotEmpty('proxy', $this->client);
	}


	public function testGetCache() {
		$this->assertInstanceOf(Cache::class, $this->client->getCache());
	}


	public function testGetContent() {
		$content = $this->client->getContent('test3', 'video/*');
		$this->assertNull($content);

		$content = $this->client->getContent('test');
		$this->assertEquals('test content', $content);
		$this->assertFileExists($this->client->getCache()->getPath('test'));
		$content = $this->client->getContent('test');
		$this->assertEquals('test content', $content);

		$content = $this->client->getContent('test2');
		$this->assertNull($content);
	}


	public function testGetFile() {
		$folder = __DIR__ . '/files/';

		$this->assertFileNotExists($this->client->getCache()->getPath('test.ru/index.php'));

		$file = $this->client->getFile('test.ru/index.php', $folder, true);

		$this->assertEquals($folder . 'index.php', $file);

		$this->assertFileExists($folder . 'index.php');

		$this->assertFileExists($this->client->getCache()->getPath('test.ru/index.php'));

		$this->client->getFile('test.ru/index.php', $folder, true);
	}


	public function testGetFiles() {
		$path = __DIR__ . '/files';

		$files = [
			[
				'test.ru/index.php',
				'test.ru/README.md',
				'test.ru/LICENCE',
			], [
				$path . '/index.php',
				$path . '/README.md',
				$path . '/LICENCE',
			],
		];

		$this->assertDirectoryNotExists($path);

		$result = $this->client->getFiles($files[ 0 ], $path);

		$this->assertEquals($files[ 1 ], $result);

		$this->assertDirectoryExists($path);

		foreach ($files[ 1 ] as $file) {
			$this->assertFileExists($file);
		}

		$result = $this->client->getFiles($files[ 0 ], $path, false, true);

		$this->assertEquals(implode(',', $files[ 1 ]), $result);

	}
}
