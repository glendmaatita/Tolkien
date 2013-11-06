<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildPageTest extends \PHPUnit_Framework_TestCase
{
	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );
		$this->init->create();
	}

	public function testBuildPage()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml') );

		$page_1 = new GeneratePage( $config, $this->prepareProperties( 'Contact (revised)') );
		$page_1->generate();

		$page_2 = new GeneratePage( $config, $this->prepareProperties( 'About') );
		$page_2->generate();

		$page_3 = new GeneratePage( $config, $this->prepareProperties( 'Portofolio') );
		$page_3->generate();

		$buildPage = new BuildPage($config, $parser);
		$buildPage->build();

		$pages = $buildPage->getNodes();

		$this->assertTrue( is_array($pages) );

		$this->assertEquals($pages[1]->getTitle(), 'Contact (revised)');
		$this->assertEquals($pages[1]->getFile(), 'contact-revised.markdown');
		$this->assertEquals($pages[1]->getLayout(), 'page' );
		$this->assertEquals($pages[1]->getPath(), basename(realpath(ROOT_DIR)) .'/' . '_pages/contact-revised.markdown' );
		$this->assertEquals($pages[1]->getUrl(), '/contact-revised.html' );
	}

	public function rrmdir($dir) 
	{
		foreach(glob("{$dir}/*") as $file)
    {
        if(is_dir($file)) { 
            $this->rrmdir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dir);
	}

	public function prepareProperties($title)
	{
		return array(
			'title' => $title,
			'type' => 'page',
			'layout' => 'page',
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