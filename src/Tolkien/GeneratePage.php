<?php namespace Tolkien;

class GeneratePage implements GenerateNode
{
	private $title;
	private $config;

	public function __construct($config, $title)
	{
		$this->config = $config;
		$this->title = $title;
	}

	public function generate()
	{
		file_put_contents( $this->setPath(), $this->setPostContent() );
	}

	public function setPath()
	{
		return $this->config['dir']['page'] . '/' . str_replace(" ", "-", strtolower($this->title)) . '.markdown';
	}

	public function setPostContent()
	{
		$content = "---\n";
		$content .= "type: page\n";
		$content .= "layout: page\n";
		$content .= "title: " . $this->title . "\n";
		$content .= "---\n";

		return $content;
	}
}