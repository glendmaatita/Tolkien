<?php namespace Tolkien;

class GeneratePost implements GenerateNode
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
		return $this->config['dir']['post'] . '/' . Date('Y-m-d') . '-' . str_replace(" ", "-", strtolower($this->title)) . '.markdown';
	}

	public function setPostContent()
	{
		$content = "---\n";
		$content .= "type: post\n";
		$content .= "layout: post\n";		
		$content .= "title: " . $this->title . "\n";
		$content .= "date: " . Date('Y-m-d') . "\n";
		$content .= "author:" . "\n";
		$content .= "  name: Your Name" . "\n";
		$content .= "  email: Your Email" . "\n";
		$content .= "  facebook: Your Facebook" . "\n";
		$content .= "  twitter: Your Twitter" . "\n";
		$content .= "  github: Your Github" . "\n";
		$content .= "  signature: Your Signature" . "\n";
		$content .= "categories: category1" . "\n";
		$content .= "---\n";

		return $content;
	}
}