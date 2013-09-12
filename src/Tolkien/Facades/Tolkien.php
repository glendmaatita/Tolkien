<?php namespace Tolkien\Facades;

use Tolkien\Factories\BuildFactory;
use Tolkien\CompileSite;

class Tolkien
{
	public static $config = ROOT_DIR . '/config.yml';

	public static function build($type)
	{
		$factory = new BuildFactory(self::$config, $title);
		$buildNode = $factory->generate();
		$buildNode->generate();
	}

	public static function generate($type = '', $title)
	{
		$factory = new GenerateFactory(self::$config, $title);
		$generateNode = $factory->generate();
		$generateNode->generate();
	}

	public static function compile()
	{
		$factory = new BuildFactory(self::config, 'site');
		$site = $factory->build();

		$compiler = new CompileSite(self::$config, $compiler);
		$compiler->compile();
	}
}