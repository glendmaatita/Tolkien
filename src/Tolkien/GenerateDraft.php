<?php namespace Tolkien;

class GenerateDraft implements GenerateNode
{
	private $config;
	private $title;

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
		return $this->config['dir']['draft'] . '/'  . str_replace(" ", "-", strtolower($this->title)) . '.markdown';
	}

	public function setPostContent()
	{
		$content = "---\n";
		$content .= "type: draft\n";
		$content .= "layout: post\n";
		$content .= "title: " . $this->title . "\n";
		$content .= "---\n";

		return $content;
	}
}