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
	 * @var array
	 */
	private $properties;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param array $properties
	 */
	public function __construct($config, $properties)
	{
		$this->config = $config;
		$this->properties = $properties;
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
		$title = preg_replace("/[^a-zA-Z0-9]+/", " ", $this->properties['title']);
		$title = preg_replace('!\s+!', ' ', trim($title));
		
		return $this->config['dir']['post'] . '/' . Date('Y-m-d') . '-' . str_replace(" ", "-", strtolower($title)) . '.markdown';
	}

	/**
	 * Set post metadata template
	 *
	 * @return string
	 */
	public function setPostContent()
	{
		$content = "---\n";
		$content .= "type: " . $this->properties['type'] . "\n";
		$content .= "layout: " . $this->properties['layout'] . "\n";		
		$content .= "title: " . $this->properties['title'] . "\n";
		$content .= "date: " . Date('Y-m-d') . "\n";
		$content .= "author: ". $this->properties['author'] ." \n";
		$content .= "categories: " . implode(',', $this->properties['categories']) . "\n";
		$content .= "---\n";
		$content .= $this->properties['body'];

		return $content;
	}
}