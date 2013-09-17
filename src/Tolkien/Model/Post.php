<?php namespace Tolkien\Model;

/**
 * Post is Node with Author, Published Date, excerpt, categories, etc
 */
class Post extends Node
{
	/**
	 * @var DateTime
	 */
	private $publishDate;

	/**
	 * @var DateTime
	 */
	private $updatedDate;

	/**
	 * @var Model\Author
	 */
	private $author;

	/**
	 * Post can have some categories
	 *
	 * @var array(Model\Category)
	 */
	private $categories = array();

	/**
	 * @var string
	 */
	private $excerpt;

	/**
	 * Construct
	 *
	 * @param string $file File of Post on folder _post/
	 * @param string $title Post's Title
	 * @param string $body Post's Body
	 * @param Model\Author $author Author of Post
	 * @param array(Model\Category) Post's Categories
	 */
	public function __construct($file, $title, $body, Author $author, $categories = array())
	{
		$this->file = $file;
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->categories = $categories;
	}

	/**
	 * Set Author
	 *
	 * @param Model\Author $author
	 */
	public function setAuthor(Author $author)
	{
		$this->author = $author;
	}

	/**
	 * Get Author
	 *
	 * @return Model\Author $author
	 */ 
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Set Published Date. Generated when user create post file in _post/
	 *
	 */
	public function setPublishDate()
	{
		$name_separate = explode('-', $this->getFileName(), 4);
		$this->publishDate = $name_separate[0] . '-' . $name_separate[1] . '-' .$name_separate[2];
	}

	/**
	 * Get Published Date
	 *
	 * @return string $publishDate
	 */
	public function getPublishDate()
	{
		return $this->publishDate;
	}

	/**
	 * Set array of Categories to Post. Post can have some categories
	 *
	 * @param array(Model\Category) $categories
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Get Categories of Post
	 *
	 * @return array(Model\Categories) $categories
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Set a Category to Post
	 *
	 * @param Model\Category $category
	 */
	public function setCategory($category)
	{
		$this->categories[] = $category;
	}

	/**
	 * Get a Category of Post
	 *
	 * @return Category $categories[$key]
	 */
	public function getCategory($key)
	{
		return $this->categories[$key];
	}

	/**
	 * Set Updated Date to Post
	 *
	 * @todo set updated date 
	 */
	public function setUpdatedDate()
	{

	}

	/**
	 * Get Updated Date
	 *
	 * @return string $updatedDate
	 */
	public function getUpdatedDate()
	{
		return $this->updatedDate;
	}

	/**
	 * Set URL to Post
	 * URL must be year/month/date/post_name.html
	 * 
	 * @return void
	 */
	public function setUrl()
	{
		$this->url = '/' . implode('/', explode('-', $this->getFileName(), 4)) . '.html';
	}

	/**
	 * Get URL of Post
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set Excerpt to Post
	 *
	 * @todo set excerpt
	 */
	public function setExcerpt($excerpt)
	{
		$this->excerpt = $excerpt;
	}

	/**
	 * Get Excerpt of Post
	 *
	 * @return string $excerpt
	 */
	public function getExcerpt()
	{
		return $this->excerpt;
	}
}