<?php namespace Tolkien\Model;

class Draft extends Node
{
	private $author;
	private $categories;

	public function __construct($file, $title, $body, Author $author, $categories = array())
	{
		$this->file = $file;
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->categories = $categories;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setFile($file)
	{
		$this->file = $file;
	}

	public function getFile()
	{
		return $this->file;
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

	public function setUrl()
	{

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