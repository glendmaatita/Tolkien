<?php namespace Tolkien\Facades;

use Tolkien\Factories\BuildFactory;
use Tolkien\Factories\GenerateFactory;
use Tolkien\CompileSite;
use Symfony\Component\Yaml\Parser;

class Tolkien
{	
	public static function config()
	{
		return ROOT_DIR . '/config.yml';
	}

	public static function build($type)
	{
		$factory = new BuildFactory(self::config(), $title);
		$buildNode = $factory->generate();
		$buildNode->generate();
	}

	public static function generate($type = '', $title)
	{
		$factory = new GenerateFactory(self::config(), $type, array('title' => $title));
		$generateNode = $factory->generate();
		$generateNode->generate();
	}

	public static function compile()
	{
		$factory = new BuildFactory(self::config(), 'site');
		$site = $factory->build();

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( self::config() ));

		$loader = new \Twig_Loader_Filesystem( $config['dir']['layout'] );
		$twig = new \Twig_Environment($loader);

		$compiler = new CompileSite($site, $config, $twig);
		$compiler->compile();
	}
}