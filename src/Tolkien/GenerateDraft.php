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
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param string $title
	 */
	public function __construct($config, $title, $type)
	{
		$this->config = $config;
		$this->title = $title;
		$this->type = $type;
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
		return $this->config['dir']['draft'] . '/'  . str_replace(" ", "-", strtolower($this->title)) . '.markdown.' . $this->type;
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
		$content .= "title: " . $this->title . "\n";
		$content .= "---\n";

		return $content;
	}
}