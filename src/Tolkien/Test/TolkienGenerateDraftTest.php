<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienInitDraftTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->init->create();
	}

	public function testCreateDraft()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . '/config.yml' ));

		$draft = new GenerateDraft( $config, "Latest Android Release", 'post' );

		$draft->generate();

		// cek if file created
		$this->assertFileExists( $draft->setPath() );

		// cek file is written by config
		$this->assertNotEmpty(file_get_contents($draft->setPath()));
	}

}