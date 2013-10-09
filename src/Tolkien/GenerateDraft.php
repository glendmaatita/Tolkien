<?php namespace Tolkien;

/**
 * Generate draft file and placed under _drafts/
 * Use command : tolkien generate draft [title]
 */
class GenerateDraft implements GenerateNode
{

	/**
	 * @var array
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
	 * @param string $title
	 */
	public function __construct($config, $properties)
	{
		$this->config = $config;
		$this->properties = $properties;
	}

	/**
	 * Create draft file to _drafts/
	 *
	 * @return void
	 */
	public function generate()
	{
		file_put_contents( $this->setPath(), $this->setPostContent() );
	}

	/**
	 * Set file location to create
	 *
	 * @return string
	 */
	public function setPath()
	{
		return $this->config['dir']['draft'] . '/'  . str_replace(" ", "-", strtolower($this->properties['title'])) . '.markdown.' . $this->properties['type'];
	}

	/**
	 * Set draft metadata template
	 *
	 * @return string
	 */
	public function setPostContent()
	{
		$content = "---\n";
		$content .= "type: draft\n";
		$content .= "layout: post\n";
		$content .= "title: " . $this->properties['title'] . "\n";
		$content .= "---\n";

		return $content;
	}
}