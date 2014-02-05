<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\Category;
use Tolkien\Model\Pagination;

class BuildCategory implements BuildNode
{

	/**
	 * @var array
	 */
	private $config;

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
	public function __construct($config, $posts)
	{
		$this->config = $config;
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

		// build paginations for each categories
		$this->setPaginations($this->categories);
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
	 * Set Paginations for category
	 *
	 * @return void
	 */
	public function setPaginations()
	{
		$pageNumber = -1; // first loop will be 0
		$count = 0;

		foreach ($this->categories as $index => $category) // get each category
		{
			$cposts = $category->getPosts(); // get all posts on a category
			// get all pagination for each category, still empty -> array()
			$cpaginations = $category->getPaginations(); 

			while( $count < count( $cposts ) )
			{
				$i = 0; // $i define post per page
				$pageNumber++; 

				if($pageNumber == 0)
					$pagination = new Pagination($pageNumber, '/categories/' . $category->getFormattedName($category->getName()) . '.html'); // URL for category 'PHP Notes' will be php-notes.html
				else
					$pagination = new Pagination($pageNumber, '/categories/' . $category->getFormattedName($category->getName()) . '/' . $pageNumber . '.html');

				while($i < $this->config['config']['pagination'] && $count < count($cposts))
				{
					$pagination->setPost($cposts[$count]);
					$i++;
					$count++;
				}

				if(isset($cpaginations[$pageNumber - 1]))
				{
					$pagination->setPreviousPage($cpaginations[$pageNumber - 1]);
					$cpaginations[$pageNumber - 1]->setNextPage($pagination);
				}
				$cpaginations[] = $pagination; // set pagination
			}

			$this->categories[$index]->setPaginations($cpaginations); // set paginations to categories
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