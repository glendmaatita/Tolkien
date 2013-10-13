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
	 * @param string $name
	 * @return $string
	 */
	public static function config($name)
	{
		return $name . '/config.yml';
	}

	/**
	 * API for build node
	 *
	 * @param string $name Blog's name
	 * @param string $type Type of Node
	 * @return void
	 */
	public static function build($name, $type)
	{
		$factory = new BuildFactory(self::config($name), $type);
		$buildNode = $factory->build();
		$buildNode->build();
		return $buildNode->getNodes();
	}

	/**
	 * API for generate node
	 *
	 * @param string $name Blog's name
	 * @param string $type Type of Nde
	 * @param array $properties Title, dll
	 * @return void
	 */
	public static function generate($name, $properties)
	{
		/**
		 * $properties
		 *
		 * for Page : array(type, title, layout, body)
		 * for Post : array(type, title, layout, author, categories, body)
		 */
		$factory = new GenerateFactory(self::config($name), $properties);
		$generateNode = $factory->generate();
		$generateNode->generate();
	}

	/**
	 * API for compile (create file)
	 *
	 * @param string $name
	 * @return void
	 */
	public static function compile($name)
	{
		$factory = new BuildFactory(self::config($name), 'site');
		$buildSite = $factory->build();

		$site = $buildSite->build();

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( self::config($name) ));

		$loader = new \Twig_Loader_Filesystem( $config['dir']['layout'] );
		$twig = new \Twig_Environment($loader);

		$compiler = new CompileSite($site, $config, $twig);
		$compiler->compile();
	}

	/**
	 * Serve Tolkien with built in webserver
	 */
	public static function serve($name)
	{
		shell_exec('php -S localhost:3000 -t ' . $name . '/_sites');
	}
}