<?php namespace Tolkien\Facades;

use Tolkien\Factories\BuildFactory;
use Tolkien\Factories\GenerateFactory;
use Tolkien\CompileSite;
use Symfony\Component\Yaml\Parser;

/**
 * Main class to provide simple API
 */
class Tolkien
{	

	/**
	 * Return config.yml location
	 *
	 * @return $string
	 */
	public static function config()
	{
		return ROOT_DIR . '/config.yml';
	}

	/**
	 * API for build node
	 *
	 * @return void
	 */
	public static function build($type)
	{
		$factory = new BuildFactory(self::config(), $title);
		$buildNode = $factory->generate();
		$buildNode->generate();
	}

	/**
	 * API for generate node
	 *
	 * @return void
	 */
	public static function generate($type = '', $title)
	{
		$factory = new GenerateFactory(self::config(), $type, array('title' => $title));
		$generateNode = $factory->generate();
		$generateNode->generate();
	}

	/**
	 * API for compile (create file)
	 *
	 * @return void
	 */
	public static function compile()
	{
		$factory = new BuildFactory(self::config(), 'site');
		$buildSite = $factory->build();

		$site = $buildSite->build();

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( self::config() ));

		$loader = new \Twig_Loader_Filesystem( $config['dir']['layout'] );
		$twig = new \Twig_Environment($loader);

		$compiler = new CompileSite($site, $config, $twig);
		$compiler->compile();
	}
}