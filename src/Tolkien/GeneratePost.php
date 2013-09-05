<?php namespace Tolkien;

/**
 * Generate a post file and placed under _posts/
 * Use command : tolkien generate post [title]
 */
class GeneratePost implements GenerateNode
{

	/**
	 * @var array $config Result parsing from config.yml
	 */
	private $config;

	/**
	 * @var string $title Post title
	 */
	private $title;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param string $title
	 */
	public function __construct($config, $title)
	{
		$this->config = $config;
		$this->title = $title;
	}

	/**
	 * Create file on _posts/
	 *
	 * @return void
	 */
	public function generate()
	{
		file_put_contents( $this->setPath(), $this->setPostContent() );
	}

	/**
	 * Set file location. Must be on _posts/date-xyz.markdown
	 * 
	 * @return string
	 */
	public function setPath()
	{
		return $this->config['dir']['post'] . '/' . Date('Y-m-d') . '-' . str_replace(" ", "-", strtolower($this->title)) . '.markdown';
	}

	/**
	 * Set post metadata template
	 *
	 * @return string
	 */
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