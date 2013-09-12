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
		$this->createBootstrap();	
		$this->createBlogDirectory();
		$this->createConfigFile();
		$this->createTemplateFile();
	}

	public function createBootstrap()
	{
		$bootstrap = __DIR__. '/../../src/Tolkien/Includes/bootstrap.php';
		if( !file_exists( $bootstrap ) )
		{
			file_put_contents( $bootstrap, "<?php \n define('BASE_DIR', __DIR__ . '/../../../" . $this->name . "/'); \n define('ROOT_DIR', basename(BASE_DIR) . '/'); " );
			include $bootstrap;
		}
	}

	/**
	 * Create Blog App Directories
	 *
	 * @return void
	 */
	public function createBlogDirectory()
	{
		@mkdir( BASE_DIR , 0700 );
		$this->config = $this->configContent();		
		@mkdir( $this->config['dir']['post'], 0700 );
		@mkdir( $this->config['dir']['page'], 0700 );
		@mkdir( $this->config['dir']['draft'], 0700 );
		@mkdir( $this->config['dir']['site'], 0700 );
		@mkdir( $this->config['dir']['asset'], 0700 );
		@mkdir( $this->config['dir']['layout'], 0700 );		
	}

	/**
	 * Creating Config file : config.yml on the root blog app
	 *
	 * @return void
	 */
	public function createConfigFile()
	{
		$dumper = new Dumper();
		file_put_contents( ROOT_DIR . '/config.yml', $dumper->dump( $this->configContent(), 2 ) );
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

		file_put_contents( $this->config['dir']['asset'] . '/css/style.css', file_get_contents(__DIR__ . '/tpl/style.css.tpl'));

		// index html
		file_put_contents( $this->config['dir']['layout'] . '/index.html.tpl', file_get_contents(__DIR__ . '/tpl/index.html.tpl'));

		// post layout
		file_put_contents( $this->config['dir']['layout'] . '/post.html.tpl', file_get_contents(__DIR__ . '/tpl/post.html.tpl'));
		
		// page layout
		file_put_contents( $this->config['dir']['layout'] . '/page.html.tpl', file_get_contents(__DIR__ . '/tpl/page.html.tpl'));

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
	public function configContent()
	{
		return $array = array(
				"config" => array(
					"name" => $this->name, 
					"title" => "Your Site Title",
					"tagline" => "Your Site Tagline" ),
				"dir" => array(
					"post" => ROOT_DIR . "_posts",
					"page" => ROOT_DIR . "_pages",
					"draft" => ROOT_DIR . "_drafts",
					"site" => ROOT_DIR . "_sites",
					"asset" => ROOT_DIR . "_assets",
					"layout" => ROOT_DIR . "_layouts",
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