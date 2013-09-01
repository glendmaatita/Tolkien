<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildPostTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog1');
		$this->init->create();
	}

	public function testGeneratePost()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . $this->init->getName() . '/config.yml' ));

		$initPost = new InitPost("Hello World", Date('Y-m-d'), $config);
		$initPost->create();

		$this->assertFileExists( $config['dir']['post'] . '/' . $initPost->prepareTitle() . '.markdown' );

		$buildPost = new BuildPost($config);
		$buildPost->build();

		// cek if file created
		$this->assertFileExists( $config['dir']['site'] . '/' . $initPost->prepareTitle() . '.markdown' );
	}
}