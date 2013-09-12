<?php namespace Tolkien;

/**
 * Generate static site from nodes
 * Use Command : tolkien compile
 */
class CompileSite
{
	private $site;
	private $config;
	private $twig;

	public function __construct($site, $config, $twig)
	{
		$this->site = $site;
		$this->config = $config;
		$this->twig = $twig;
	}

	public function compile()
	{		
		$this->compilePosts();
		$this->compilePages();
		$this->compileAssets();
	}

	public function compilePosts()
	{
		foreach ($this->site->getPosts() as $post) 
		{			
			$template = $this->twig->loadTemplate( $post->getLayout() . '.html.tpl');
			$content = $template->render(array('site' => $this->site, 'post' => $post ));
			$this->createFile($content, $post);
		}		
	}

	public function compilePages()
	{		
		foreach ($this->site->getPages() as $page)
		{			
			$template = $this->twig->loadTemplate( $page->getLayout() . '.html.tpl');
			$content = $template->render(array('site' => $this->site, 'page' => $page));
			$this->createFile($content, $page);
		}
	}

	public function compileAssets()
	{
		foreach ($this->site->getAssets() as $asset)
		{
			if(!file_exists(dirname($asset->getUrl()) ))
    		mkdir(dirname($asset->getUrl()), 0777, true);

			copy( $asset->getPath(), $asset->getUrl() );
		}
	}

	public function createFile($content, $node)
	{
		if(!file_exists(dirname($this->config['dir']['site'] . '/' . $node->getUrl())))
    	mkdir(dirname($this->config['dir']['site'] . '/' . $node->getUrl()), 0777, true);

    file_put_contents($this->config['dir']['site'] . '/' . $node->getUrl(), $content);
	}
}