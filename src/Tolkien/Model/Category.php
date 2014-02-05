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
	 * @var array(Model\Pagination) Pagination
	 */
	private $paginations;

	/**
	 * Construct
	 *
	 * @param string $name
	 * @param array(Tolkien\Model\Post) $posts
	 */
	public function __construct($name = '', $posts = array(), $paginations = array())
	{
		$this->name = $name;
		$this->posts = $posts;
		$this->paginations = $paginations;
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
		$this->url = '/categories/' . $this->getFormattedName($name) . '.html';
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

	/**
	 * set site's paginations
	 *
	 * @param array(Model\Pagination)
	 */
	public function setPaginations($paginations)
	{
		$this->paginations = $paginations;
	}

	/**
	 * Get all site's paginations
	 *
	 * @return array(Model\Pagination)
	 */
	public function getPaginations()
	{
		return $this->paginations;
	}

	/**
	 * Get name properly for category's URL
	 * Category with name 'PHP Notes' will have URl : php-notes
	 *
	 * @param string $name
	 * @return string
	 */
	public function getFormattedName($name)
	{
		return str_replace(" ", "-", strtolower($name));
	}
}