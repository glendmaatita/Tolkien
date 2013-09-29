<?php namespace Tolkien;

use Tolkien\Model\Pagination;

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
		$pageNumber = -1;
		$count = 0;

		while($count < count($this->posts))
		{
			$i = 0; // $i define post per page
			$pageNumber++; 

			if($pageNumber == 0)
				$pagination = new Pagination($pageNumber, '/index.html');
			else
				$pagination = new Pagination($pageNumber, '/index' . $pageNumber . '.html');

			while($i < $this->config['config']['pagination'] && $count < count($this->posts))
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