<?php namespace Tolkien\Factories;

use Tolkien\GeneratePost;
use Tolkien\GenerateDraft;
use Tolkien\GeneratePage;
use Symfony\Component\Yaml\Parser;

/**
 * Special Class for create instance of GenerateNode
 */
class GenerateFactory
{

	/**
	 * @var string
	 */
	private $config;

	/**
	 * @var array
	 */
	private $properties;

	/**
	 * Construct
	 *
	 * @param string $config Location of config.yml
	 * @oaram string $type
	 * @param array $properties
	 */
	public function __construct($config, $properties = array())
	{
		$this->config = $config;
		$this->properties = $properties;
	}

	/**
	 * Create class instance of GenerateNode
	 */
	public function generate()
	{
		switch ($this->properties['type']) {
			case 'post':
				return new GeneratePost($this->prepareConfig($this->config), $this->properties);
				break;

			case 'draft':
				return new GenerateDraft($this->prepareConfig($this->config), $this->properties);
				break;

			case 'page':
				return new GeneratePage($this->prepareConfig($this->config), $this->properties);
				break;
			
			default:
				return;
				break;
		}
	}

	/**
	 * Parsing config.yml
	 *
	 * @param string $config Location of config.yml
	 * @return array
	 */
	public function prepareConfig($config)
	{
		$parser = new Parser();
		return $parser->parse(file_get_contents( $config ));
	}
}