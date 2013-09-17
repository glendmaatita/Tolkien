<?php namespace Tolkien\Model;

class SiteCategory extends Category
{

	/**
	 * @var string Link to Category Page
	 */
	private $url;

	private $posts = array();

	public function __construct($name = '', $posts = array())
	{
		parent::__construct($name);
		$this->posts = $posts;
		$this->setUrl();
	}

	/**
	 * Set URL for Category Page
	 *
	 * @param string $url
	 */
	public function setUrl()
	{
		$this->url = '/categories/' . $this->getName() . '.html';
	}

	/**
	 * Get URL of Category page
	 *
	 * @return string
	 */
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

	public function setPost($post)
	{
		$this->posts[] = $post;
	}
}