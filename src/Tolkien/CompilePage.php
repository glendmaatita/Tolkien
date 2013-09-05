<?php namespace Tolkien;

/**
 * Generate static website from _/pages into site/
 */
class CompilePage implements CompileNode
{

	/**
	 * @var array(Model\Page)
	 */
	private $pages = array();

	/**
	 * @var array 
	 */
	private $config;

	/**
	 * Construct
	 * @param array $config
	 * @param array(Model\Page)	$pages
	 */
	public function __construct($config, $pages)
	{
		$this->config = $config;
		$this->pages = $pages;
	}

	
	public function compile()
	{
		$loader = new \Twig_Loader_Filesystem( $this->config['dir']['layout'] );
		$twig = new \Twig_Environment($loader);

		foreach ($this->pages as $page)
		{
			// define template
			$template = $twig->loadTemplate( $page->getLayout() . '.html.tpl');
			$content = $template->render(array('page' => $page));
			$this->createFile($content, $page);
		}
	}

	public function createFile($content, $page)
	{
    file_put_contents($this->config['dir']['site'] . '/' . $page->getUrl(), $content);
	}
}