<?php namespace Tolkien\Factories;

use Tolkien\GeneratePost;
use Tolkien\GenerateDraft;
use Tolkien\GeneratePage;
use Symfony\Component\Yaml\Parser;

class GenerateFactory
{
	private $config;
	private $type;
	private $properties;

	public function __construct($config, $type = 'post', $properties = array())
	{
		$this->config = $this->prepareConfig($config);
		$this->type = $type;
		$this->properties = $properties;
	}

	public function generate()
	{
		switch ($this->type) {
			case 'post':
				return new GeneratePost($this->config, $this->properties['title']);
				break;

			case 'draft':
				return new GenerateDraft($this->config, $this->properties['title'], $this->properties['type']);
				break;

			case 'page':
				return new GeneratePage($this->config, $this->properties['title']);
				break;
			
			default:
				return;
				break;
		}
	}

	public function prepareConfig($config)
	{
		$parser = new Parser();
		$this->config = $parser->parse(file_get_contents( $config ));
	}
}