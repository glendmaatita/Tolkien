<?php namespace Tolkien\Model;

/**
 * Category of Model\Post
 */
class Category 
{
	/**
	 * @var string Category's Name
	 */ 
	protected $name;

	/** 
	 * Construct
	 *
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Set Name of Category
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Get Name of Category
	 *
	 * @return string $name
	 */
	public function getName()
	{
		return $this->name;
	}
}