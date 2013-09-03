<?php namespace Tolkien\Model;

class Page extends Node
{
	public function __construct($file, title, $body)
	{
		$this->file = $file;
		$this->title = $title;
		$this->body = $body;
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

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	public function getLayout()
	{
		return $this->layout;
	}
}