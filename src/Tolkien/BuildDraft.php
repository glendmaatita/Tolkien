<?php namespace Tolkien;

use Tolkien\Model\Draft;
use Tolkien\Model\Category;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

// build draft : draft become post on _post

class BuildDraft implements BuildNode
{
	private $config;
	private $files = array();
	private $parser;

	public function __construct($config, $parser, $files)
	{
		$this->config = $config;
		$this->parser = $parser;
		$this->files = $files;
	}

	public function build()
	{
		foreach ($files as $file)
		{
			$draft = explode('.', $file);
			$ext = array_pop($draft);

			if( $ext == 'page')
				$this->generatePost(implode('.', $draft), $file);
			else if( $ext == 'page')
				$this->generatePage(implode('.', $draft), $file);
		}
	}

	public function generatePost($draft, $file)
	{
		file_put_contents( $this->config['dir']['post'] . '/' . Date('Y-m-d') . '-' . $draft, file_get_contents( $this->config['dir']['draft'] . '/' . $file));
	}

	public function generatePage($draft, $file)
	{
		file_put_contents( $this->config['dir']['page'] . '/' . $draft, file_get_contents( $this->config['dir']['draft'] . '/' . $file));
	}
}