<?php namespace Tolkien\Factories;

use Symfony\Component\Yaml\Parser;

use Tolkien\BuildAsset;
use Tolkien\BuildPage;
use Tolkien\BuildPost;
use Tolkien\BuildCategory;
use Tolkien\BuildPagination;
use Tolkien\BuildAuthor;
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
	 * Draft will be build or not 
	 */
	private $with_draft;

	/**
	 * Construct
	 *
	 * @param string $config Content of config.yml
	 * @param string $type What is you want to build ?
	 */
	public function __construct($config, $type = 'post', $with_draft = false)
	{
		$this->config = $this->prepareConfig($config);
		$this->type = $type;
		$this->with_draft = $with_draft;
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

			case 'page':
				return $this->getBuildPage();
				break;

			case 'post':
				return $this->getBuildPost();
				break;

			case 'category':
				return $this->getBuildCategory();
				break;

			case 'pagination':
				return $this->getBuildPagination();
				break;

			case 'author':
				return $this->getBuildAuthor();
				break;

			case 'site':
				return new BuildSite($this->config, $this->getBuildAsset(), $this->getBuildPage(), $this->getBuildPost(), $this->getBuildCategory(), $this->getBuildPagination(), $this->getBuildAuthor() );
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
		return new BuildAsset($this->config, $this->getParser());
	}

	/** 
	 * Get instance of BuildPage
	 *
	 * @return BuildPage
	 */
	public function getBuildPage()
	{		
		return new BuildPage($this->config, $this->getParser());
	}

	/**
	 * Get instance of BuildPost
	 *
	 * @return BuildPost
	 */
	public function getBuildPost()
	{		
		return new BuildPost($this->config, $this->getParser(), $this->with_draft);
	}

	/**
	 * Get instance of BuildCategory
	 *
	 * @return BuildCategory
	 */
	public function getBuildCategory()
	{
		$buildPost = $this->getBuildPost();
		$buildPost->build();
		return new BuildCategory($buildPost->getNodes());
	}

	/**
	 * Get instance of BuildPagination
	 *
	 * @return BuildPagination
	 */
	public function getBuildPagination()
	{
		$buildPost = $this->getBuildPost();
		$buildPost->build();
		return new BuildPagination($this->config, $buildPost->getNodes());
	}

	/**
	 * Get instance of BuildAuthor
	 *
	 * @return BuildAuthor
	 */
	public function getBuildAuthor()
	{
		$buildPost = $this->getBuildPost();
		$buildPost->build();
		return new BuildAuthor($this->config, $buildPost->getNodes());
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