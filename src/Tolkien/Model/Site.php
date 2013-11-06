<?php namespace Tolkien\Model;

/**
 * Site is your website. Consists of title, tagline, all your posts and pages, etc
 */
class Site
{

	/**
	 * @var string URL of your site ex: http://myblog.com
	 */
	private $url;

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
	 * @var array(Model\Asset) Assets of your site
	 */
	private $assets = array();

	/**
	 * @var array(Model\Category) Categories
	 */
	private $categories = array();

	/**
	 * @var array(Model\Pagination) Pagination
	 */
	private $paginations = array();

	/**
	 * @var array(Model\Author) Author
	 */
	private $authors = array();

	/**
	 * Construct
	 *
	 * @param string $title
	 * @param string $tagline
	 */
	public function __construct($url, $title, $tagline = '', $posts = array(), $pages = array(), $categories = array(), $assets = array(), $paginations = array(), $authors = array())
	{
		$this->title = $title;
		$this->url = $url;
		$this->tagline = $tagline;
		$this->posts = $posts;
		$this->pages = $pages;
		$this->categories = $categories;
		$this->assets = $assets;
		$this->paginations = $paginations;
		$this->authors = $authors;
	}

	/**
	 * Set URL
	 *
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Get url of site
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
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
	 * Get Tagline
	 *
	 * @return string
	 */
	public function getTagline()
	{
		return $this->tagline;
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
		return $this->posts;
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

	/**
	 * Set Assets of your site
	 *
	 * @param array(Model\Asset) $asset
	 */
	public function setAssets($assets)
	{
		$this->assets = $assets;
	}

	/**
	 * Get all assets
	 *
	 * @return array(Model\Asset) $asset
	 */
	public function getAssets()
	{
		return $this->assets;
	}

	/**
	 * Set a Asset
	 *
	 * @param Model\Asset $page
	 */
	public function setAsset($asset)
	{
		$this->assets[] = $asset;
	}

	/**
	 * Get a Asset
	 *
	 * @return Model\Asset $page
	 */
	public function getAsset($asset)
	{
		return $this->assets[$asset];
	}

	/**
	 * Set Categories of your site
	 *
	 * @param array(Model\Category) $categories
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Get all site's categories
	 *
	 * @return array(Model\Category)
	 */
	public function getCategories()
	{
		return $this->categories;
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
	 * set site's authors
	 *
	 * @param array(Model\Author)
	 */
	public function setAuthors($authors)
	{
		$this->authors = $authors;
	}

	/**
	 * Get all site's authors
	 *
	 * @return array(Model\Author)
	 */
	public function getAuthors()
	{
		return $this->authors;
	}
}