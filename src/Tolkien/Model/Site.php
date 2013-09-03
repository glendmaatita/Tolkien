<?php namespace Tolkien\Model;

class Site
{
	private $title;
	private $tagline;
	private $posts = array();
	private $pages = array();

	public function __constrcut($title, $tagline)
	{
		$this->title = $title;
		$this->tagline = $tagline;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTagline($tagline)
	{
		$this->tagline = $tagline;
	}

	public function setPosts($posts)
	{
		$this->posts = $posts;
	}

	public function getPosts()
	{
		return $posts;
	}

	public function setPost($post)
	{
		$this->posts[] = $post;
	}

	public function getPost($post)
	{
		return $this->posts[$post];
	}

	public function setPages($pages)
	{
		$this->pages = $pages;
	}

	public function getPages()
	{
		return $this->pages;
	}

	public function setPage($page)
	{
		$this->pages[] = $page;
	}

	public function getPage($page)
	{
		return $this->pages[$page];
	}
}