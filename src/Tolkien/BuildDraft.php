<?php namespace Tolkien;

use Tolkien\Model\Draft;
use Tolkien\Model\Category;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

/**
 * Make all files under _drafts/ become post file in _posts/
 */
class BuildDraft implements BuildNode
{

	/**
	 * @var array $config from config.yml
	 */
	private $config;

	/**
	 * @var array $files All files on folder _drafts/
	 */
	private $files = array();

	/**
	 * @var Symfony\Component\Yaml\Parser $parser YAML parser from Symfony
	 */
	private $parser;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param Parser $parse
	 * @param array $files
	 */
	public function __construct($config, $parser, $files)
	{
		$this->config = $config;
		$this->parser = $parser;
		$this->files = $files;
	}

	/**
	 * Generate a post file from draft and put it on folder _posts/
	 */
	public function build()
	{
		foreach ($files as $file)
		{

			/**
			 * Get file name without extension post/page
			 * from xyz.markdown.post become xyz.markdown
			 */
			$draft = explode('.', $file);
			$ext = array_pop($draft);

			if( $ext == 'post')
				$this->generatePost(implode('.', $draft), $file);
			else if( $ext == 'page')
				$this->generatePage(implode('.', $draft), $file);
			else
				return;
		}
	}

	/**
	 * Create a post file from draft into folder _posts/ with same name
	 */
	public function generatePost($draft, $file)
	{
		file_put_contents( $this->config['dir']['post'] . '/' . Date('Y-m-d') . '-' . $draft, file_get_contents( $this->config['dir']['draft'] . '/' . $file));
	}

	/**
	 * Create a page file from draft into folder _pages/ with same name
	 */
	public function generatePage($draft, $file)
	{
		file_put_contents( $this->config['dir']['page'] . '/' . $draft, file_get_contents( $this->config['dir']['draft'] . '/' . $file));
	}
}