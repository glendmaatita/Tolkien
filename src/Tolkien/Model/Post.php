<?php namespace Tolkien\Model;

class Post extends Node
{
	private $publishDate;
	private $updatedDate;
	private $author;
	private $categories = array();
	private $excerpt;

	public function __construct($file, $title, $body, Author $author, $categories = array())
	{
		$this->file = $file;
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->categories = $categories;
	}

	public function setFile($file)
	{
		$this->file = $file;
	}

	public function getFile()
	{
		return $this->file;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setBody($body)
	{
		$this->body = $body;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function setAuthor(Author $author)
	{
		$this->author = $author;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function setPublishDate()
	{
		$this->publishDate = Date('Y-m-d');
	}

	public function getPublishDate()
	{
		return $this->publishDate;
	}

	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	public function getCategories()
	{
		return $this->categories;
	}

	public function setCategory($category)
	{
		$this->categories[] = $category;
	}

	public function getCategory($key)
	{
		return $this->categories[$key];
	}

	public function setUpdatedDate()
	{

	}

	public function getUpdatedDate()
	{
		return $this->updatedDate;
	}

	public function setUrl()
	{
		$this->url = implode('/', explode('-', $this->getFileName(), 4)) . '.html';
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setExcerpt()
	{

	}

	public function getExcerpt()
	{
		return $this->excerpt;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	public function getLayout()
	{
		return $this->layout;
	}
}