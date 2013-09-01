<?php namespace Tolkien;

class InitPost
{

	private $title;
	private $date;
	private $config;
	private $draft;

	public function __construct($title, $date, $config, $draft = false)
	{
		$this->title = $title;
		$this->date = $date;
		$this->config = $config;
		$this->draft = $draft;
	}

	public function create()
	{
		$this->createPostFile();
	}

	public function createPostFile()
	{
		file_put_contents( $this->setFileName() , $this->postContent() );
	}

	public function postContent()
	{
		$content = "---\n";
		$content .= "layout: post\n";
		$content .= "title: " . $this->title . "\n";
		$content .= "data: " . $this->date . "\n";
		$content .= "None\n";
		$content .= "---\n";

		return $content;
	}

	public function setFileName()
	{
		if($this->draft)
			return $this->config['dir']['draft'] . '/' . $this->prepareTitle() . '.markdown';
		else
			return $this->config['dir']['post'] . '/' . $this->prepareTitle() . '.markdown';
	}

	public function prepareTitle()
	{
		if($this->draft)
			return str_replace(" ", "-", strtolower($this->title));
		else
			return $this->date . '-' . str_replace(" ", "-", strtolower($this->title));
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getDate()
	{
		return $this->date;
	}
}