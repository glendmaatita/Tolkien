<?php namespace Tolkien\Model;

class SiteCategory extends Category
{

	/**
	 * @var string Link to Category Page
	 */
	private $url;

	public function __construct($name)
	{
		parent::__construct($name);
		$this->setUrl();
	}

	/**
	 * Set URL for Category Page
	 *
	 * @param string $url
	 */
	public function setUrl()
	{
		$this->url = 'categories/' . $this->getName() . '.html';
	}

	/**
	 * Get URL of Category page
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}
}