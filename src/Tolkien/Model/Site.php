<?php namespace Tolkien\Model;

/**
 * Site is your website. Consists of title, tagline, all your posts and pages, etc
 */
class Site
{

	/**
	 * @var string Title of Your Web
	 */
	private $title;

	/**
	 * @var string Tagline
	 */
	private $tagline;

	/**
	 * @var array(Model\Post) Posts of your website
	 */
	private $posts = array();

	/**
	 * @var array(Model\Page) Pages of your site
	 */
	private $pages = array();

	/**
	 * Construct
	 *
	 * @param string $title
	 * @param string $tagline
	 */
	public function __constrcut($title, $tagline)
	{
		$this->title = $title;
		$this->tagline = $tagline;
	}

	/**
	 * Set Title
	 *
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Get title of site
	 *
	 * @return string $title
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set Tagline
	 *
	 * @param string $tagline
	 */
	public function setTagline($tagline)
	{
		$this->tagline = $tagline;
	}

	/**
	 * Set Posts of Site
	 *
	 * @param array(Model\Post) Posts
	 */
	public function setPosts($posts)
	{
		$this->posts = $posts;
	}

	/**
	 * Get all posts
	 *
	 * @return array(Model\Post)
	 */
	public function getPosts()
	{
		return $posts;
	}

	/**
	 * Set only a Post 
	 *
	 * @param Model\Post $post
	 */
	public function setPost($post)
	{
		$this->posts[] = $post;
	}

	/**
	 * Get a post
	 *
	 * @return Model\Post $post
	 */
	public function getPost($post)
	{
		return $this->posts[$post];
	}

	/**
	 * Set Pages of your site
	 *
	 * @param array(Model\Page) $pages
	 */
	public function setPages($pages)
	{
		$this->pages = $pages;
	}

	/**
	 * Get all pages
	 *
	 * @return array(Model\Page) $page
	 */
	public function getPages()
	{
		return $this->pages;
	}

	/**
	 * Set a Page
	 *
	 * @param Model\Page $page
	 */
	public function setPage($page)
	{
		$this->pages[] = $page;
	}

	/**
	 * Get a Page
	 *
	 * @return Model\Page $page
	 */
	public function getPage($page)
	{
		return $this->pages[$page];
	}
}