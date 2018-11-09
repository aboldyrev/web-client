<?php

use Aboldyrev\Cache;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class CacheTest extends TestCase
{
	/** @var Cache $cache */
	private $cache;


	protected function setUp() {
		parent::setUp();
		$directory = __DIR__ . '/cache';

		$filesystem = new Filesystem();
		$filesystem->remove($directory);
		$this->cache = new Cache($directory);
	}


	public function testCreate() {
		$cache = new Cache(__DIR__ . '/cache');

		$this->assertInstanceOf(Cache::class, $cache);
	}


	public function testEmpty() {

		$this->assertTrue($this->cache->isEmptyCache());

		$this->cache->put('ya.ru', 'test data');

		$this->assertFalse($this->cache->isEmptyCache());
	}


	public function testCheckMimeType() {
		$this->cache->put('ya.ru', 'test data');

		$this->assertTrue($this->cache->checkMimeType('ya.ru', 'text/plain'));

		$this->assertTrue($this->cache->checkMimeType('ya.ru', 'text/*'));
	}


	public function testCheckDate() {
		$this->cache->put('ya.ru', 'test data');

		$this->assertTrue($this->cache->checkDate('ya.ru'));

		$this->assertFalse($this->cache->checkDate('ya.ru', Carbon::now()->subDay()));

		$this->assertFalse($this->cache->checkDate('not.exist'));
	}


	public function testCheck() {
		$this->assertFalse($this->cache->check('ya.ru'));

		$this->cache->put('ya.ru', 'test data');

		$this->assertTrue($this->cache->check('ya.ru'));
	}


	public function testGetContent() {
		$this->cache->put('ya.ru', 'test data');

		$this->assertEquals('test data', $this->cache->get('ya.ru'));

		$this->assertNull($this->cache->get('test.null'));
	}


	public function testCacheMethod() {

		$this->assertTrue($this->cache->isEmptyCache());

		$this->cache->cache('ya.ru', 'test data');

		$this->assertFalse($this->cache->isEmptyCache());

		$this->assertEquals('test data', $this->cache->cache('ya.ru'));

	}


	public function testForget() {

		$this->cache->cache('ya.ru/test', 'test data');
		$this->assertFileExists($this->cache->getPath('ya.ru/test'));
		$this->cache->forget('ya.ru/test');
		$this->assertFileNotExists($this->cache->getPath('ya.ru/test'));

		$this->cache->cache('ya.ru/test', 'test data');
		$this->assertDirectoryExists($this->cache->getPath('ya.ru', true));
		$this->cache->forget('ya.ru');
		$this->assertDirectoryNotExists($this->cache->getPath('ya.ru', true));

		$this->cache->cache('ya.ru/test', 'test data');
		$this->assertDirectoryExists(__DIR__ . '/cache');
		$this->cache->forget();
		$this->assertDirectoryNotExists(__DIR__ . '/cache');
	}


	public function testGetPath() {
		$this->assertEquals(
			__DIR__ . '/cache/ya.ru/test.txt',
			$this->cache->getPath('ya.ru/test.txt')
		);

		$this->assertEquals(
			__DIR__ . '/cache/ya.ru',
			$this->cache->getPath('ya.ru/test.txt', true)
		);
	}
}
