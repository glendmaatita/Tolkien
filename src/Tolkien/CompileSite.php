<?php namespace Tolkien; 

/**
 * Generate static site from nodes
 * Use Command : tolkien compile
 */
class CompileSite
{

	/**
	 * @var Tolkien\Model\Site
	 */
	private $site;

	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var Twig_Environment
	 */
	private $twig;

	/**
	 * Construct
	 *
	 * @param Tolkien\Model\Site $site
	 * @param array $config
	 * @param Twig_Environment $twig
	 */
	public function __construct($site, $config, $twig)
	{
		$this->site = $site;
		$this->config = $config;
		$this->twig = $twig;
	}

	/**
	 * Main function to compile
	 *
	 * @return void
	 */
	public function compile()
	{		
		$this->compilePosts();
		$this->compilePages();
		$this->compileSiteCategories();
		$this->compileAssets();
		$this->compilePagination();
	}

	/**
	 * Compile Post
	 *
	 * @return void
	 */
	public function compilePosts()
	{
		foreach ($this->site->getPosts() as $post) 
		{			
			$template = $this->twig->loadTemplate( $post->getLayout() . '.html.tpl');
			$content = $template->render(array('site' => $this->site, 'post' => $post ));
			$this->createFile($content, $post);
		}		
	}

	/**
	 * Compile Pages
	 *
	 * @return void
	 */
	public function compilePages()
	{		
		foreach ($this->site->getPages() as $page)
		{			
			$template = $this->twig->loadTemplate( $page->getLayout() . '.html.tpl');
			$content = $template->render(array('site' => $this->site, 'page' => $page));
			$this->createFile($content, $page);
		}
	}

	/**
	 * Compile Site Categories
	 *
	 * @return void
	 */
	public function compileSiteCategories()
	{
		foreach ($this->site->getSiteCategories() as $siteCategory) 
		{
			$template = $this->twig->loadTemplate( 'site_categories.html.tpl' );
			$content = $template->render(array('site' => $this->site, 'siteCategory' => $siteCategory));
			$this->createFile($content, $siteCategory);
		}
	}

	/**
	 * Compile Pagination
	 *
	 * @return void
	 */
	public function compilePagination()
	{
		foreach ($this->site->getPaginations() as $pagination) 
		{
			$template = $this->twig->loadTemplate( 'index.html.tpl' );
			$content = $template->render(array('site' => $this->site, 'pagination' => $pagination));
			$this->createFile($content, $pagination);
		}
	}

	/**
	 * Compile Assets
	 *
	 * @return void
	 */
	public function compileAssets()
	{
		foreach ($this->site->getAssets() as $asset)
		{
			if(!file_exists(dirname($asset->getUrl()) ))
    		mkdir(dirname($asset->getUrl()), 0777, true);

			copy( $asset->getPath(), $asset->getUrl() );
		}
	}

	/**
	 * Create file
	 *
	 * @param string $content
	 * @param Tolkien\Model\Node
	 * @return void
	 */
	public function createFile($content, $node)
	{
		if(!file_exists(dirname($this->config['dir']['site'] . '/' . $node->getUrl())))
    	mkdir(dirname($this->config['dir']['site'] . '/' . $node->getUrl()), 0777, true);

    file_put_contents($this->config['dir']['site'] . '/' . $node->getUrl(), $content);
	}
}