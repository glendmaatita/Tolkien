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
	private $siteCategories = array();

	/**
	 * @var array(string)
	 */
	private $categoriesName = array();

	/**
	 * @var array(Model\SiteCategory)
	 */
	private $categories = array();

	/**
	 * Construct
	 *
	 * @param array(Model\Post) $posts
	 */
	public function __construct($posts)
	{
		$this->posts = $posts;
	}

	/**
	 * Build Site Category
	 *
	 * @return void
	 */
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
			$categoryName = strtolower($category->getName());
			if(in_array($categoryName, array_map('strtolower', $this->categoriesName)))
			{
				$this->siteCategories[$categoryName]->setPost($post);
				continue;
			}

			$this->siteCategories[$categoryName] = new SiteCategory($categoryName);
			$this->siteCategories[$categoryName]->setPost($post);
			$this->categoriesName[] = $categoryName;			
		}
	}

	/**
	 * Get all site categories
	 *
	 * @return array(Model\SiteCategory)
	 */
	public function getNodes()
	{
		return $this->siteCategories;
	}
}