<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienGeneratePageTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->init->create();
	}

	public function testCreatePage()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . '/config.yml' ));

		$page = new GeneratePage( $config, $this->prepareProperties( "About Us" ) );

		$page->generate();

		// cek if file created
		$this->assertFileExists( $page->setPath() );

		// cek file is written by config
		$this->assertNotEmpty(file_get_contents($page->setPath()));
	}

	public function prepareProperties($title)
	{
		return array(
			'title' => $title,
			'type' => 'post',
			'layout' => 'post',
			'author' => array(
				'name' => 'Your Name',
				'email' => 'Your Email',
				'facebook' => 'Your Facebook',
				'twitter' => 'Your Twitter',
				'github' => 'Your Github',
				'signature' => 'Your Signature',			
				),
			'categories' => array('category1'),
			'body' => 'Body of Content'
			);
	}
}