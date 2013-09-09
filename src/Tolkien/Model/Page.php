<?php namespace Tolkien\Model;

/**
 * Page is Node, has no Author, Published Date, Excerpt, or etc. Just a page of web
 */
class Page extends Node
{
	/**
	 * Construct
	 *
	 * @param string $file File Name of Page in folder _pages/
	 * @param string title Title of Page
	 * @param string body Body of Page
	 */
	public function __construct($file, $title, $body)
	{
		$this->file = $file;
		$this->title = $title;
		$this->body = $body;
	}

	/**
	 * Set URL for page. URL must be only SITENAME.com/page_name.html
	 */
	public function setUrl()
	{
		$this->url = $this->getFileName() . '.html';
	}

	/**
	 * Get URL of page
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}
}