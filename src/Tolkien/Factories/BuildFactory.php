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

	public function generate()
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
				return new BuildSite($this->config, $this->getBuildAsset(), $this->getBuildPage(), $this->getBuildPost(), $this->getBuildSiteCategory());
				break;
			
			default:
				return;
				break;
		}
	}

	public function getBuildAsset()
	{
		$parser = new Parser();
		return new BuildAsset($this->config, $parser);
	}

	public function getBuildDraft()
	{
		$parser = new Parser();
		return new BuildDraft($this->config, $parser);
	}

	public function getBuildPage()
	{
		$parser = new Parser();
		return new BuildPage($this->config, $parser);
	}

	public function getBuildPost()
	{
		$parser = new Parser();
		return new BuildPost($this->config, $parser);
	}

	public function getBuildSiteCategory()
	{
		$buildPost = $this->getBuildPost();
		$buildPost->build();
		return new BuildSiteCategory($buildPost->getPosts());
	}
}