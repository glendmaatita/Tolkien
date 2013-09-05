<?php namespace Tolkien;

/**
 * Generate a page file and placed under _pages/
 *
 * Use command : tolkien generate page [title]
 */
class GeneratePage implements GenerateNode
{

	/**
	 * @var string Page title
	 */
	private $title;

	/**
	 * @var array $config Result parsing from config.yml
	 */
	private $config = array();

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
		return $this->config['dir']['page'] . '/' . str_replace(" ", "-", strtolower($this->title)) . '.markdown';
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
		$content .= "layout: page\n";
		$content .= "title: " . $this->title . "\n";
		$content .= "---\n";

		return $content;
	}
}