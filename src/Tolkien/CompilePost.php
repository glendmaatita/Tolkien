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

		//var_dump($this->posts);die();

		$template = $twig->loadTemplate('index.html.tpl');
		echo $template->render(array('posts' => $this->posts, 'categories' => array('cat1', 'cat2')));
		die();

	}
}