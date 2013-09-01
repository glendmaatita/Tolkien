<?php namespace Tolkien;

use Symfony\Component\Yaml\Dumper;

class Init 
{
	private $name;
	private $config;

	public function __construct($name)
	{
		$this->name = $name;
	}

	// create blog directory
	public function create()
	{
		$this->createConfigFile();
		$this->createBlogDirectory();		
	}

	public function createBlogDirectory()
	{
		$this->config = $this->configContent();
		@mkdir( ROOT_DIR . $this->name , 0700 );
		@mkdir( $this->config['dir']['asset'], 0700 );
		@mkdir( $this->config['dir']['post'], 0700 );
		@mkdir( $this->config['dir']['site'], 0700 );
		@mkdir( $this->config['dir']['draft'], 0700 );
		@mkdir( $this->config['dir']['layout'], 0700 );
		@mkdir( $this->config['dir']['site_draft'], 0700 );
	}

	public function createConfigFile()
	{
		$dumper = new Dumper();
		file_put_contents( ROOT_DIR . $this->name . '/config.yml', $dumper->dump( $this->configContent(), 2 ) );
	}

	public function getName()
	{
		return $this->name;
	}

	public function createIndexFile()
	{
		
	}

	public function configContent()
	{
		return $array = array(
				"config" => array( 
					"app" => $this->name, 
					"name" => "Your Blog Name " . $this->name, 
					"title" => "Your Site Title" ),
				"dir" => array(
					"post" => ROOT_DIR . $this->name . "/_posts",
					"draft" => ROOT_DIR . $this->name . "/_drafts",
					"asset" => ROOT_DIR . $this->name . "/_assets",
					"site" => ROOT_DIR . $this->name . "/_sites",
					"site_draft" => ROOT_DIR . $this->name . "/_drafts/sites",
					"layout" => ROOT_DIR . $this->name . "/_layouts",
					)
			);
	}
}