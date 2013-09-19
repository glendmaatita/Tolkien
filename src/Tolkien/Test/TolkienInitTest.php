<?php namespace Tolkien;

use Tolkien\Init;
use Symfony\Component\Yaml\Parser;

class TolkienInitTest extends \PHPUnit_Framework_TestCase
{
	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );
		$this->init->create();
	}

	public function testCreateBlog()
	{	
		// cek if directory created
		$this->assertFileExists( ROOT_DIR );

		// create directory assets
		$this->assertFileExists( ROOT_DIR . '/_assets' );
		$this->assertFileExists( ROOT_DIR . '/_assets/css' );

		// create directory posts
		$this->assertFileExists( ROOT_DIR . '/_posts' );

		// create directory sites
		$this->assertFileExists( ROOT_DIR . '/_sites' );

		// create draft sites
		$this->assertFileExists( ROOT_DIR . '/_drafts' );

		// create page sites
		$this->assertFileExists( ROOT_DIR . '/_pages' );

		// create layouts
		$this->assertFileExists( ROOT_DIR . '/_layouts' );

		//cek if config file exist
		$this->assertFileExists( ROOT_DIR . '/config.yml' );

		//cek if index.html
		//$this->assertFileExists( ROOT_DIR . '/index.html' );

		// validate configfile
		$this->assertContains('config', file_get_contents( ROOT_DIR . 'config.yml'));
	}

	public function testConfigFile()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml'));

		$this->assertEquals( $this->init->getName() , $config['config']['name']);
		$this->assertContains( $this->init->getName() , $config['config']['name']);
		$this->assertEquals( basename(realpath(ROOT_DIR)) . '/' . '_posts' , $config['dir']['post']);
		$this->assertEquals( basename(realpath(ROOT_DIR)) . '/' . '_pages' , $config['dir']['page']);
		$this->assertEquals( basename(realpath(ROOT_DIR)) . '/' . '_drafts' , $config['dir']['draft']);
		$this->assertEquals( basename(realpath(ROOT_DIR)) . '/' . '_sites' , $config['dir']['site']);
		$this->assertEquals( basename(realpath(ROOT_DIR)) . '/' . '_layouts' , $config['dir']['layout']);
		$this->assertEquals( basename(realpath(ROOT_DIR)) . '/' . '_assets' , $config['dir']['asset']);
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
}