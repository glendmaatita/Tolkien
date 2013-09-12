<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\SiteCategory;

class BuildSiteCategory implements BuildNode
{

	/**
	 * @var array(Model\Post) Extract Categories of posts
	 */
	private $posts;

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
			$this->categories = array_merge($this->categories, $post->getCategories());
		}
	}

	/**
	 * Get all Site Categories
	 *
	 * @return array(Model\SiteCategories)
	 */
	public function getSiteCategories()
	{
		$siteCategories = array();
		$categoriesName = array();
		foreach ($this->categories as $category) 
		{
			if(in_array($category->getName(), $categoriesName))
				continue;

			$siteCategories[] = new SiteCategory($category->getName());
			$categoriesName[] = $category->getName();
		}

		return $siteCategories;
	}
}