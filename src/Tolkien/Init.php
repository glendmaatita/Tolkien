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
		$this->createBlogDirectory();
		$this->createConfigFile();
		$this->createTemplateFile();
	}

	public function createBlogDirectory()
	{
		$this->config = $this->configContent();
		@mkdir( ROOT_DIR . $this->name , 0700 );
		@mkdir( $this->config['dir']['post'], 0700 );
		@mkdir( $this->config['dir']['page'], 0700 );
		@mkdir( $this->config['dir']['draft'], 0700 );
		@mkdir( $this->config['dir']['site'], 0700 );
		@mkdir( $this->config['dir']['asset'], 0700 );
		@mkdir( $this->config['dir']['layout'], 0700 );		
	}

	public function createConfigFile()
	{
		$dumper = new Dumper();
		file_put_contents( ROOT_DIR . $this->name . '/config.yml', $dumper->dump( $this->configContent(), 2 ) );
	}

	public function createTemplateFile()
	{		
		
		// css
		if (!is_dir($this->config['dir']['asset'] . '/css')) {
		  // dir doesn't exist, make it
		  mkdir($this->config['dir']['asset'] . '/css');
		}
		file_put_contents( $this->config['dir']['asset'] . '/css/style.css', file_get_contents(__DIR__ . '/../tpl/style.css.tpl'));

		// index html
		file_put_contents( $this->config['dir']['layout'] . '/index.html.tpl', file_get_contents(__DIR__ . '/../tpl/index.html.tpl'));

		// post layout
		file_put_contents( $this->config['dir']['layout'] . '/post.html.tpl', file_get_contents(__DIR__ . '/../tpl/post.html.tpl'));
		
		// page layout
		file_put_contents( $this->config['dir']['layout'] . '/page.html.tpl', file_get_contents(__DIR__ . '/../tpl/page.html.tpl'));

		// sidebar layout
		file_put_contents( $this->config['dir']['layout'] . '/sidebar.html.tpl', file_get_contents(__DIR__ . '/../tpl/sidebar.html.tpl'));

		// header layout
		file_put_contents( $this->config['dir']['layout'] . '/header.html.tpl', file_get_contents(__DIR__ . '/../tpl/header.html.tpl'));

		// master layout
		file_put_contents( $this->config['dir']['layout'] . '/layout.html.tpl', file_get_contents(__DIR__ . '/../tpl/layout.html.tpl'));


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
					"page" => ROOT_DIR . $this->name . "/_pages",
					"draft" => ROOT_DIR . $this->name . "/_drafts",
					"site" => ROOT_DIR . $this->name . "/_sites",
					"asset" => ROOT_DIR . $this->name . "/_assets",
					"layout" => ROOT_DIR . $this->name . "/_layouts",
					)
			);
	}

	public function getName()
	{
		return $this->name;
	}
}