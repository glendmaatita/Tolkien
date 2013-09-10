<?php namespace Tolkien\Facades;

use Tolkien\Factories\GenerateFactory;

class GenerateFacade
{

	public static $config = ROOT_DIR . '/config.yml';

	public static function generate($title, $type = '')
	{
		$factory = new GenerateFactory(self::$config, $title);
		$generateNode = $factory->generate();
		$generateNode->generate();
	}
}