<?php namespace Tolkien;

class CompilePost implements CompileNode
{
	private $posts = array();
	private $config;
	
	public function __construct($config, $posts)
	{
		$this->config = $config;
		$this->posts = $posts;
	}

	public function compile()
	{
		$loader = new \Twig_Loader_Filesystem( $this->config['dir']['layout'] );
		$twig = new \Twig_Environment($loader);

		foreach ($this->posts as $post) 
		{
			// define template
			$template = $twig->loadTemplate( $post->getLayout() . '.html.tpl');
			$content = $template->render(array('post' => $post));
			$this->createFile($content, $post);
		}
	}

	public function createFile($content, $post)
	{
		if(!file_exists(dirname($this->config['dir']['site'] . '/' . $post->getUrl())))
    	mkdir(dirname($this->config['dir']['site'] . '/' . $post->getUrl()), 0777, true);

    file_put_contents($this->config['dir']['site'] . '/' . $post->getUrl(), $content);
	}
}