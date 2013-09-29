<?php namespace Model;

class Pagination
{
	private $posts = array();
	private $previousPage;
	private $nextPage;
	private $numberPage;
	private $url;

	public function __construct($numberPage = 1, $url = '', $posts = array(), $previousPage = null, $nextPage = null)
	{
		$this->numberPage = $numberPage;
		$this->url = $url;
		$this->posts = $posts;
		$this->previousPage = $previousPage;
		$this->nextPage = $nextPage;
	}

	public function setNumberPage($numberPage)
	{
		$this->numberPage = $numberPage;
	}

	public function getNumberPage()
	{
		return $this->numberPage;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setPosts($posts)
	{
		$this->posts = $posts;
	}

	public function getPosts()
	{
		return $this->posts;
	}

	public function setPreviousPage($previousPage)
	{
		$this->previousPage = $previousPage;
	}

	public function getPreviousPage()
	{
		return $this->previousPage;
	}

	public function setNextPage($nextPage)
	{
		$this->nextPage = $nextPage;
	}

	public function getNextPage()
	{
		return $this->nextPage;
	}
}