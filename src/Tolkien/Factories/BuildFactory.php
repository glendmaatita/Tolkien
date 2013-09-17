<?php namespace Tolkien\Factories;

use Symfony\Component\Yaml\Parser;

use Tolkien\BuildAsset;
use Tolkien\BuildDraft;
use Tolkien\BuildPage;
use Tolkien\BuildPost;
use Tolkien\BuildSiteCategory;
use Tolkien\BuildSite;

/**
 * Special Class to produce class instance
 */
class BuildFactory
{

	/**
	 * @var string
	 */
	private $config;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * Construct
	 *
	 * @param string $config Content of config.yml
	 * @param string $type What is you want to build ?
	 */
	public function __construct($config, $type = 'post')
	{
		$this->config = $config;
		$this->type = $type;
	}

	/**
	 * Main method to get class instance of BuildNode
	 *
	 * @return BuildNode
	 */
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

	/**
	 * Get instance of BuildAsset
	 *
	 * @return BuildAsset
	 */
	public function getBuildAsset()
	{		
		return new BuildAsset($this->prepareConfig($this->config), $this->getParser());
	}

	/**
	 * Get instance of BuildDraft
	 *
	 * @return BuildDraft
	 */
	public function getBuildDraft()
	{
		return new BuildDraft($this->prepareConfig($this->config), $this->getParser());
	}

	/** 
	 * Get instance of BuildPage
	 *
	 * @return BuildPage
	 */
	public function getBuildPage()
	{		
		return new BuildPage($this->prepareConfig($this->config), $this->getParser());
	}

	/**
	 * Get instance of BuildPost
	 *
	 * @return BuildPost
	 */
	public function getBuildPost()
	{		
		return new BuildPost($this->prepareConfig($this->config), $this->getParser());
	}

	/**
	 * Get instance of BuildSiteCategory
	 *
	 * @return BuildSiteCategory
	 */
	public function getBuildSiteCategory()
	{
		$buildPost = $this->getBuildPost();
		$buildPost->build();
		return new BuildSiteCategory($buildPost->getPosts());
	}

	/**
	 * Get new instance Parser
	 *
	 * @return Parser
	 */
	public function getParser()
	{
		return new Parser();
	}

	/**
	 * Parsing config.yml
	 *
	 * @return array
	 */
	public function prepareConfig($config)
	{
		return $this->getParser()->parse(file_get_contents( $config ));
	}
}