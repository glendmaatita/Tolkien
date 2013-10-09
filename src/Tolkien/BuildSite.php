<?php namespace Tolkien;

use Tolkien\Model\Site;

/**
 * Build Site
 */
class BuildSite
{

	/**
	 * @var BuildAsset
	 */
	private $buildAsset;

	/**
	 * @var BuildPage
	 */
	private $buildPage;

	/**
	 * @var BuildPost
	 */
	private $buildPost;

	/**
	 * @var BuildSiteCategory
	 */
	private $buildSiteCategory;

	/**
	 * @var BuildPagination
	 */
	private $buildPagination;

	/**
	 * @var array
	 */
	private $config;

	/**
	 * Construct
	 *
	 * @param array $config Parse from config.yml
	 * @param BuildAsset $buildAsset
	 * @param BuildPage $buildPage
	 * @param BuildPost $buildPost
	 * @param BuildSiteCategory $buildSiteCategory
	 */
	public function __construct($config, $buildAsset, $buildPage, $buildPost, $buildSiteCategory, $buildPagination)
	{
		$this->config = $config;
		$this->buildAsset = $buildAsset;
		$this->buildPage = $buildPage;
		$this->buildPost = $buildPost;
		$this->buildSiteCategory = $buildSiteCategory;
		$this->buildPagination = $buildPagination;
	}

	/**
	 * Main method to site
	 *
	 * @return Model\Site
	 */
	public function build()
	{
		return new Site($this->config['config']['url'], $this->config['config']['title'], $this->config['config']['tagline'], $this->getPosts(), $this->getPages(), $this->getSiteCategories(), $this->getAssets(), $this->getPaginations() );
	}

	/**
	 * Build Post
	 *
	 * @return array(Model\Site)
	 */
	public function getPosts()
	{
		$this->buildPost->build();
		return $this->buildPost->getNodes();
	}

	/**
	 * Build Page
	 *
	 * @return array(Model\Page)
	 */
	public function getPages()
	{
		$this->buildPage->build();
		return $this->buildPage->getNodes();
	}

	/**
	 * Build Site Category
	 * 
	 * @return Model\SiteCategory
	 */
	public function getSiteCategories()
	{
		$this->buildSiteCategory->build();
		return $this->buildSiteCategory->getNodes();
	}

	/**
	 * Build Asset
	 *
	 * @return Model\Asset
	 */
	public function getAssets()
	{
		$this->buildAsset->build();
		return $this->buildAsset->getNodes();
	}

	/**
	 * Build Pagination
	 *
	 * @return Model\Pagination
	 */
	public function getPaginations()
	{
		$this->buildPagination->build();
		return $this->buildPagination->getNodes();
	}
}