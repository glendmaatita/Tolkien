<?php namespace Tolkien\Model;

/**
 * Category of posts
 */
class Category
{

	private $name;

	/**
	 * @var string Link to Category Page
	 */
	private $url;

	/**
	 * @var array(Tolkien\Model\Post)
	 */
	private $posts = array();

	/**
	 * Construct
	 *
	 * @param string $name
	 * @param array(Tolkien\Model\Post) $posts
	 */
	public function __construct($name = '', $posts = array())
	{
		$this->name = $name;
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
		$name = preg_replace("/[^a-zA-Z0-9]+/", " ", $this->getName());
		$name = preg_replace('!\s+!', ' ', trim($name));
		$this->url = '/categories/' . str_replace(" ", "-", strtolower($name)) . '.html';
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

	/**
	 * Set posts of site
	 *
	 * @param array(Tolkien\Model\Post)
	 */
	public function setPosts($posts)
	{
		$this->posts = $posts;
	}

	/**
	 * Get posts of site
	 *
	 * @return array(Tolkien\Model\Post)
	 */
	public function getPosts()
	{
		return $this->posts;
	}

	/**
	 * Set a post to Category
	 *
	 * @param Tolkien\Model\Post $post
	 */
	public function setPost($post)
	{
		$this->posts[] = $post;
	}

	/**
	 * Set Name of Category
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Get Name of Category
	 *
	 * @return string $name
	 */
	public function getName()
	{
		return $this->name;
	}
}