<?php namespace Tolkien;

/**
 * Generate a page file and placed under _pages/
 *
 * Use command : tolkien generate page [title]
 */
class GeneratePage implements GenerateNode
{

	/**
	 * @var array
	 */
	private $properties;

	/**
	 * @var array $config Result parsing from config.yml
	 */
	private $config = array();

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
	 * Create file to _pages/
	 *
	 * @return void
	 */
	public function generate()
	{
		file_put_contents( $this->setPath(), $this->setPageContent() );
	}

	/**
	 * Set path for generated file. Path must be on _pages/xyz.markdown
	 *
	 * @return string
	 */
	public function setPath()
	{
		return $this->config['dir']['page'] . '/' . str_replace(" ", "-", strtolower($this->properties['title'])) . '.markdown';
	}

	/**
	 * Set Metadata's template for page
	 *
	 * @return string $content
	 */
	public function setPageContent()
	{
		$content = "---\n";
		$content .= "type: page\n";
		$content .= "layout: " . $this->properties['layout'] . "\n";
		$content .= "title: " . $this->properties['title'] . "\n";
		$content .= "---\n";
		$content .= $this->properties['body'];

		return $content;
	}
}