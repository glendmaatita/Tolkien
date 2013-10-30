<?php namespace Tolkien;

use Symfony\Component\Yaml\Dumper;

/**
 * Blog app Initiation
 */
class Init 
{

	/**
	 * @var string Name of your blog
	 */
	private $name;

	/**
	 * @var array parsed from config.yml
	 */
	private $config;

	/**
	 * Construct
	 *
	 * @param string name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Create blog app with all its mandatory folder
	 *
	 * @return void
	 */
	public function create()
	{	
		$blog_dir = getcwd() . '/' . $this->name . '/';
		$this->createBlogDirectory($blog_dir);
		$this->createConfigFile($blog_dir);
		$this->createAuthorFile($blog_dir);
		$this->createTemplateFile($blog_dir);
	}

	/**
	 * Create Blog App Directories
	 *
	 * @return void
	 */
	public function createBlogDirectory($blog_dir)
	{
		@mkdir($blog_dir , 0777, true );
		$this->config = $this->configContent( $blog_dir );
		@mkdir( $this->config['dir']['post'], 0777, true );
		@mkdir( $this->config['dir']['page'], 0777, true );
		@mkdir( $this->config['dir']['site'], 0777, true );
		@mkdir( $this->config['dir']['asset'], 0777, true );
		@mkdir( $this->config['dir']['layout'], 0777, true );	
	}

	/**
	 * Creating Config file : config.yml on the root blog app
	 *
	 * @return void
	 */
	public function createConfigFile($blog_dir)
	{
		$dumper = new Dumper();
		file_put_contents( $blog_dir . 'config.yml', $dumper->dump( $this->configContent($blog_dir), 2 ) );
	}

	public function createAuthorFile($blog_dir)
	{
		$dumper = new Dumper();
		file_put_contents( $blog_dir . 'author.yml', $dumper->dump( $this->authorConfigContent($blog_dir), 2 ) );
	}

	/**
	 * Creating template file. Template will be used for view
	 *
	 * @return void
	 */
	public function createTemplateFile()
	{		
		// css
		if (!is_dir($this->config['dir']['asset'] . '/css')) {
		  // dir doesn't exist, make it
		  mkdir($this->config['dir']['asset'] . '/css');
		}

		//js
		if (!is_dir($this->config['dir']['asset'] . '/js')) {
		  mkdir($this->config['dir']['asset'] . '/js');
		}

		// css file
		file_put_contents( $this->config['dir']['asset'] . '/css/bootstrap.min.css', file_get_contents(__DIR__ . '/tpl/css/bootstrap.min.css'));
		file_put_contents( $this->config['dir']['asset'] . '/css/bootstrap-theme.min.css', file_get_contents(__DIR__ . '/tpl/css/bootstrap-theme.min.css'));

		// js file
		file_put_contents( $this->config['dir']['asset'] . '/js/jquery.js', file_get_contents(__DIR__ . '/tpl/js/jquery.js'));
		file_put_contents( $this->config['dir']['asset'] . '/js/bootstrap.min.js', file_get_contents(__DIR__ . '/tpl/js/bootstrap.min.js'));

		// index html
		file_put_contents( $this->config['dir']['layout'] . '/index.html.tpl', file_get_contents(__DIR__ . '/tpl/index.html.tpl'));

		// post layout
		file_put_contents( $this->config['dir']['layout'] . '/post.html.tpl', file_get_contents(__DIR__ . '/tpl/post.html.tpl'));
		
		// page layout
		file_put_contents( $this->config['dir']['layout'] . '/page.html.tpl', file_get_contents(__DIR__ . '/tpl/page.html.tpl'));

		// page layout
		file_put_contents( $this->config['dir']['layout'] . '/category.html.tpl', file_get_contents(__DIR__ . '/tpl/category.html.tpl'));

		// sidebar layout
		file_put_contents( $this->config['dir']['layout'] . '/sidebar.html.tpl', file_get_contents(__DIR__ . '/tpl/sidebar.html.tpl'));

		// header layout
		file_put_contents( $this->config['dir']['layout'] . '/header.html.tpl', file_get_contents(__DIR__ . '/tpl/header.html.tpl'));

		// master layout
		file_put_contents( $this->config['dir']['layout'] . '/layout.html.tpl', file_get_contents(__DIR__ . '/tpl/layout.html.tpl'));
	}

	/**
	 * Content of config.yml
	 *
	 * @return array
	 */
	public function configContent($blog_dir)
	{
		$base_blog = basename($blog_dir);

		return $array = array(
				"config" => array(
					"name" => $this->name, 
					"url" => '/',
					"title" => "Your Site Title",
					"tagline" => "Your Site Tagline",
					"pagination" => 10),					
				"dir" => array(
					"post" => $base_blog . "/_posts",
					"page" => $base_blog . "/_pages",
					"site" => $base_blog . "/_sites",
					"asset" => $base_blog . "/_assets",
					"layout" => $base_blog . "/_layouts",
					)
			);
	}

	public function authorConfigContent($blog)
	{
		return array(
			'tolkien' => array(
				'name' => 'John Ronald Reuel Tolkien',
				'email' => 'tolkien@kodetalk.com',
				'facebook' => 'Tolkien',
				'twitter' => '@tolkien',
				'facebook' => 'Tolkien',
				'signature' => 'Creator of LoTR Trilogy'
				)
			);
	}

	/**
	 * Get Blog app name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}