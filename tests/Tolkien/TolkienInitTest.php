<?php namespace Tolkien;

use Tolkien\Init;

class TolkienInitTest extends \PHPUnit_Framework_TestCase
{
	private $init;

	public function __construct()
	{
		$this->init = new Init('blog1');
		$this->init->create();
	}

	public function testCreateBlog()
	{		
		// cek if directory created
		$this->assertFileExists( ROOT_DIR . $this->init->getName() );

		// create directory assets
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/_assets' );

		// create directory posts
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/_posts' );

		// create directory sites
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/_sites' );

		// create draft sites
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/_drafts' );

		// create layouts
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/_layouts' );

		//cek if config file exist
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/config.yml' );

		//cek if index.html
		$this->assertFileExists( ROOT_DIR . $this->init->getName() . '/index.html' );

		// validate configfile
		$this->assertContains('config', file_get_contents( ROOT_DIR . $this->init->getName() . '/config.yml'));
	}
}