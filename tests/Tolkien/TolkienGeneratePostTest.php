<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienGeneratePostTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->init->create();
	}

	public function testCreatePost()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . $this->init->getName() . '/config.yml' ));

		$post = new GeneratePost( $config, "Latest Android Release" );

		$post->generate();

		// cek if file created
		$this->assertFileExists( $post->setPath() );

		// cek file is written by config
		$this->assertNotEmpty(file_get_contents($post->setPath()));
	}
}