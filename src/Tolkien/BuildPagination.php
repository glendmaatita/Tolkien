<?php namespace Tolkien;

use Tolkien\Model\Pagination;

/**
 * Build pagination as you want
 */
class BuildPagination implements BuildNode
{
	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var array(Model\Pagination)
	 */
	private $paginations = array();

	/**
	 * @var array(Model\Post)
	 */
	private $posts = array();

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param array(Model\Post) $posts
	 */
	public function __construct($config, $posts)
	{
		$this->config = $config;
		$this->posts = $posts;
	}

	/**
	 * Create an array of pagination
	 *
	 * @return void
	 */
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

	/**
	 * Get all pagination
	 *
	 * @return array(Model\Pagination)
	 */
	public function getNodes()
	{
		return $this->paginations;
	}
}