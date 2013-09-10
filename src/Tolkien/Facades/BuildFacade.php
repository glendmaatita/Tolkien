<?php namespace Tolkien\Facades;

use Tolkien\Factories\BuildFactory;

class BuildFacade
{

	public static $config = ROOT_DIR . '/config.yml';

	public static function build($type)
	{
		$factory = new BuildFactory(self::$config, $title);
		$buildNode = $factory->generate();
		$buildNode->generate();
	}
}