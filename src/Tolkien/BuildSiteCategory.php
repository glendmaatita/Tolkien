<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\SiteCategory;

class BuildSiteCategory implements BuildNode
{

	/**
	 * @var array(Model\Post) Extract Categories of posts
	 */
	private $posts;

	private $siteCategories = array();
	private $categoriesName = array();

	/**
	 * @var array(Model\SiteCategory)
	 */
	private $categories = array();

	public function __construct($posts)
	{
		$this->posts = $posts;
	}

	public function build()
	{
		foreach ($this->posts as $post) 
		{
			//$this->categories = array_merge($this->categories, $post->getCategories($post));
			$this->setSiteCategories($post);
		}
	}

	/**
	 * Get all Site Categories
	 *
	 * @return array(Model\SiteCategories)
	 */
	public function setSiteCategories($post)
	{
		foreach ($post->getCategories() as $category) 
		{
			if(in_array($category->getName(), $this->categoriesName))
			{
				$this->siteCategories[$category->getName()]->setPost($post);
				continue;
			}

			$this->siteCategories[$category->getName()] = new SiteCategory($category->getName());
			$this->siteCategories[$category->getName()]->setPost($post);
			$this->categoriesName[] = $category->getName();			
		}
	}

	public function getSiteCategories()
	{
		return $this->siteCategories;
	}
}