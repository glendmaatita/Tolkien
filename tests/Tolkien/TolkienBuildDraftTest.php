<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildDraftTest extends \PHPUnit_Framework_TestCase
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

		$initDraft = new InitPost("Hello World", '', $config, $draft = true);
		$initDraft->create();

		$this->assertFileExists( $config['dir']['draft'] . '/' . $initDraft->prepareTitle() . '.markdown' );

		$buildDraft = new BuildPost($config);
		$buildDraft->build();

		// cek if file created
		$this->assertFileExists( $config['dir']['site_draft'] . '/' . $initDraft->prepareTitle() . '.markdown' );
	}
}