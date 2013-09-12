<?php namespace Tolkien\Factories;

use Symfony\Component\Yaml\Parser;

use Tolkien\BuildAsset;
use Tolkien\BuildDraft;
use Tolkien\BuildPage;
use Tolkien\BuildPost;
use Tolkien\BuildSiteCategory;
use Tolkien\BuildSite;

class BuildFactory
{

	private $config;
	private $type;

	public function __construct($config, $type = 'post')
	{
		$this->config = $config;
		$this->type = $type;
	}

	public function build()
	{
		switch ($this->type) {
			case 'asset':
				return $this->getBuildAsset();
				break;

			case 'draft':
				return $this->getBuildDraft();
				break;

			case 'page':
				return $this->getBuildPage();
				break;

			case 'post':
				return $this->getBuildPost();
				break;

			case 'site_category':
				return $this->getBuildSiteCategory();
				break;

			case 'site':
				return new BuildSite($this->prepareConfig($this->config), $this->getBuildAsset(), $this->getBuildPage(), $this->getBuildPost(), $this->getBuildSiteCategory());
				break;
			
			default:
				return;
				break;
		}
	}

	public function getBuildAsset()
	{		
		return new BuildAsset($this->prepareConfig($this->config), $this->getParser());
	}

	public function getBuildDraft()
	{
		return new BuildDraft($this->prepareConfig($this->config), $this->getParser());
	}

	public function getBuildPage()
	{		
		return new BuildPage($this->prepareConfig($this->config), $this->getParser());
	}

	public function getBuildPost()
	{		
		return new BuildPost($this->prepareConfig($this->config), $this->getParser());
	}

	public function getBuildSiteCategory()
	{
		$buildPost = $this->getBuildPost();
		$buildPost->build();
		return new BuildSiteCategory($buildPost->getPosts());
	}

	public function getParser()
	{
		return new Parser();
	}

	public function prepareConfig($config)
	{
		return $this->getParser()->parse(file_get_contents( $config ));
	}
}