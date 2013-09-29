<?php namespace Tolkien\Model;

/**
 * Pagination class
 */
class Pagination
{

	/**
	 * @var array(Model\Post)
	 */
	private $posts = array();

	/**
	 * @var self
	 */
	private $previousPage;

	/**
	 * @var self
	 */
	private $nextPage;

	/**
	 * @var int
	 */
	private $numberPage;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * Construct
	 *
	 * @param int $numberPage Number of Page
	 * @param string $url URL of Page
	 * @param array(Model\Post) $posts
	 * @param Model\Pagination $previousPage
	 * @param Model\Pagination $nextPage
	 */

	public function __construct($numberPage = 1, $url = '', $posts = array(), $previousPage = null, $nextPage = null)
	{
		$this->numberPage = $numberPage;
		$this->url = $url;
		$this->posts = $posts;
		$this->previousPage = $previousPage;
		$this->nextPage = $nextPage;
	}

	/**
	 * Set Number of page
	 *
	 * @param int $numberPage
	 */
	public function setNumberPage($numberPage)
	{
		$this->numberPage = $numberPage;
	}

	/**
	 * Get Number of a page
	 *
	 * @return int
	 */
	public function getNumberPage()
	{
		return $this->numberPage;
	}

	/**
	 * Set Number of each pagination
	 *
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Get URL of pagination
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set Posts in a pagination
	 *
	 * @param array(Model\Post)
	 */
	public function setPosts($posts)
	{
		$this->posts = $posts;
	}

	/**
	 * Get all post of a pagination
	 *
	 * @return array(Model\Post)
	 */
	public function getPosts()
	{
		return $this->posts;
	}

	/**
	 * Set a post to pagination
	 *
	 * @param Model\Post
	 */
	public function setPost($post)
	{
		$this->posts[] = $post;
	}

	/**
	 * Set Pagination of previous pagination
	 *
	 * @param Model\Pagination $previosPage
	 */
	public function setPreviousPage($previousPage)
	{
		$this->previousPage = $previousPage;
	}

	/**
	 * Get Previous Pagination
	 *
	 * @return Model\Pagination
	 */
	public function getPreviousPage()
	{
		return $this->previousPage;
	}

	/**
	 * Set pagination of Next page
	 *
	 * @param Model\Pagination $nextPage
	 */
	public function setNextPage($nextPage)
	{
		$this->nextPage = $nextPage;
	}

	/**
	 * Get next pagination
	 *
	 * @return Model\Pagination
	 */
	public function getNextPage()
	{
		return $this->nextPage;
	}
}