<?php namespace Tolkien;

/**
 * Generate static site from nodes
 * Use Command : tolkien compile
 */
class CreateSite
{
	private $site;
	private $config;
	private $twig_loader;
	private $twig_env;

	public function __construct($site, $config, $twig_loader, $twig_env)
	{
		$this->site = $site;
		$this->config = $config;
	}

	public function compile()
	{		
		$this->compilePosts();
		$this->compilePages();
		$this->compileAssets();
	}

	public function compilePosts()
	{
		foreach ($this->site->posts as $post) 
		{
			$this->createFile($this->render($twig->loadTemplate( $post->getLayout() . '.html.tpl')), $post);
		}
	}

	public function compilePages()
	{
		foreach ($this->site->pages as $page)
		{
			$this->createFile($this->render($twig->loadTemplate( $page->getLayout() . '.html.tpl')), $page);
		}
	}

	public function compileAsset()
	{
		foreach ($this->site->assets as $asset)
		{
			$url_destination = array_shift(explode('/', $asset->getPath()));

			if(!file_exists(dirname($this->config['dir']['site'] . '/' . $asset->getPath())))
    		mkdir(dirname($this->config['dir']['site'] . '/' . $asset->getPath()), 0777, true);

			copy( $asset->getPath(), $this->config['dir']['site'] . $url_destination );
		}
	}

	public function render($template)
	{
		return $template->render(array('site' => $this->site));
	}

	public function createFile($content, $node)
	{
		if(!file_exists(dirname($this->config['dir']['site'] . '/' . $node->getUrl())))
    	mkdir(dirname($this->config['dir']['site'] . '/' . $node->getUrl()), 0777, true);

    file_put_contents($this->config['dir']['site'] . '/' . $node->getUrl(), $content);
	}
}