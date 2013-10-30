<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\Category;

class BuildCategory implements BuildNode
{

	/**
	 * @var array(Model\Post) Extract Categories of posts
	 */
	private $posts;

	/**
	 * @var array(Model\Category)
	 */
	private $categories = array();

	/**
	 * @var array(string)
	 */
	private $categoriesName = array();

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
			$this->setCategories($post);
		}
	}

	/**
	 * Get all Site Categories
	 *
	 * @return array(Model\Categories)
	 */
	public function setCategories($post)
	{
		foreach ($post->getCategories() as $category) 
		{
			$categoryName = strtolower($category->getName());
			if(in_array($categoryName, array_map('strtolower', $this->categoriesName)))
			{
				$this->categories[$categoryName]->setPost($post);
				continue;
			}

			$this->categories[$categoryName] = new Category($categoryName);
			$this->categories[$categoryName]->setPost($post);
			$this->categoriesName[] = $categoryName;			
		}
	}

	/**
	 * Get all site categories
	 *
	 * @return array(Model\Category)
	 */
	public function getNodes()
	{
		return $this->categories;
	}
}