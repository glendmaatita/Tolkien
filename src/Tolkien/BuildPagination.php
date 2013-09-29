<?php namespace Tolkien;

use Model\Pagination;

class BuildPagination implements BuildNode
{

	private $config;
	private $paginations = array();
	private $posts = array();

	public function __construct($config, $posts)
	{
		$this->config = $config;
		$this->posts = $posts;
	}

	public function build()
	{
		$pageNumber = 0;
		for($count = 0; $count < count($this->posts), $count++) 
		{
			$i = null; // $i define post per page
			$pageNumber++;
			$pagination = new Pagination($pageNumber, '/index' . $pageNumber . '.html');
			while($i <= $this->config['config']['pagination'])
			{
				$pagination->setPost($this->posts[$count]);
				$i++;
				$count++;
			}

			if(isset($this->paginations[$pageNumber - 1]))
			{
				$pagination->setPreviousPage($this->paginations[$pageNumber - 1]);
				$this->paginations[$pageNumber - 1]->setNextPage($pagination);
			}
			$this->paginations[] = $pagination;
		}
	}

	public function getPaginations()
	{
		return $this->paginations;
	}
}