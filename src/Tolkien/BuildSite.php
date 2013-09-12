<?php namespace Tolkien;

class BuildSite
{

	private $buildAsset;
	private $buildPage;
	private $buildPost;
	private $buildSiteCategory;

	private $config;

	public function __construct($config, $buildAsset, $buildPage, $buildPost, $buildSiteCategory)
	{
		$this->config = $config;
		$this->buildAsset = $buildAsset;
		$this->buildPage = $buildPage;
		$this->buildPost = $buildPost;
		$this->buildSiteCategory = $buildSiteCategory;
	}

	public function build()
	{
		return new Site($this->config['app']['url'], $this->config['app']['title'], $this->config['app']['tagline'], $this->getPosts(), $this->getPages(), $this->getSiteCategories(), $this->getAssets() );
	}

	public function getPosts()
	{
		$this->buildPost->build();
		return $this->buildPost->getPosts();
	}

	public function getPages()
	{
		$this->buildPage->build();
		return $this->buildPage->getPages();
	}

	public function getSiteCategories()
	{
		$this->buildSiteCategory->build();
		return $this->buildSiteCategory->getSiteCategories();
	}

	public function getAssets()
	{
		$this->buildAsset->build();
		return $this->buildAsset->getAssets();
	}
}