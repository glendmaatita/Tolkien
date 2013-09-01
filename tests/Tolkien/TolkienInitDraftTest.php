<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienInitDraftTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog1');
		$this->init->create();
	}

	public function testCreateDraft()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . $this->init->getName() . '/config.yml' ));

		$draft = new InitPost( "Latest Android Release - Draft", 'draft', $config, $draft = true );

		$draft->create();

		// cek if file created
		$this->assertFileExists( $draft->setFileName() );

		// cek file is written by config
		$this->assertNotEmpty(file_get_contents($draft->setFileName()));
	}

}