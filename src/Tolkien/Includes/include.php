<?php

//define('ROOT_DIR', basename(__DIR__ . '/../../blog/'));
/*
require_once realpath(__DIR__.'/../../../vendor/autoload.php');

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->useIncludePath(true);

$loader->registerNamespaces(array(
	'Tolkien' => __DIR__. '/../../../src/Tolkien',
	'Tolkien\Facades' => __DIR__.'/../../../src/Tolkien/Facades'
));

$loader->register();*/

if( file_exists( __DIR__. '/../../../src/Tolkien/Includes/bootstrap.php') )
{
	include __DIR__. '/../../../src/Tolkien/Includes/bootstrap.php';
}