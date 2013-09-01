<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienInitPostTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog1');
		$this->init->create();
	}

	public function testCreatePost()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . $this->init->getName() . '/config.yml' ));

		$post = new InitPost( "Latest Android Release", Date('Y-m-d'), $config );

		$post->create();

		// cek if file created
		$this->assertFileExists( $post->setFileName() );

		// cek file is written by config
		$this->assertNotEmpty(file_get_contents($post->setFileName()));
	}
}