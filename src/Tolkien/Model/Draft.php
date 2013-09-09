<?php namespace Tolkien\Model;

/**
 * Draft Node that you want to edit more. Not Published Yet Node
 * But you want to see how its rendered on browser\
 * Draft format Files: xyz.markdown.page xyz.markdown.post and put it under _drafts/ folder
 */
class Draft extends Node
{
	
	/**
	 * @var Model\Author Draft's Author
	 */
	private $author;
	/**
	 * @var array Model\Category Draft's Categories
	 */
	private $categories;

	/**
	 * Construct
	 *
	 * @param string file File name of draft on folder _drafts/
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
	 * Set Draft's Author
	 *
	 * @param Model\Author $author
	 */
	public function setAuthor(Author $author)
	{
		$this->author = $author;
	}

	/**
	 * Get Draft's Author
	 *
	 * @return Model\Author $author
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Set Categories in Array
	 *
	 * @param array(Model\Categories) $categories
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Get Categories of Draft
	 *
	 * @return array(Model\Category) $categories
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Set Category for Draft
	 *
	 * @param Category $category
	 */
	public function setCategory($category)
	{
		$this->categories[] = $category;
	}

	/**
	 * Get Category of Draft
	 *
	 * @return Category $category
	 */
	public function getCategory($key)
	{
		return $this->categories[$key];
	}

	/**
	 * Set URL for Draft
	 */
	public function setUrl()
	{

	}

	/**
	 * Get URL for Draft
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set Excerpt or Summary
	 */
	public function setExcerpt()
	{

	}

	/**
	 * Set Excerpt or Summary
	 *
	 * @return string excerpt
	 */
	public function getExcerpt()
	{
		return $this->excerpt;
	}
}