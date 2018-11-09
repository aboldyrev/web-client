<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Symfony\Component\Finder\Finder;

$dir = __DIR__ . '/src';

$iterator = Finder
	::create()
	->files()
	->name('*.php')
	->sortByName()
	->exclude([ 'docs', 'sami_cache' ])
	->in($dir);

return new Sami($iterator, [
	'title'                => 'Web client',
	'build_dir'            => __DIR__ . '/docs',
	'cache_dir'            => __DIR__ . '/sami_cache',
	'remote_repository'    => new GitHubRemoteRepository('aboldyrev/web-client', dirname($dir)),
	'default_opened_level' => 1,
]);