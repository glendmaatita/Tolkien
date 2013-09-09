<?php namespace Tolkien\Model;

/**
 * Asset is css, javascript, image, etc
 */
class Asset
{
	/**
	 * @var string URL of file after built
	 */
	private $url;

	/**
	 * @var string Origin Path of file
	 */
	private $path;
	
	/**
	 * Construct
	 * 
	 * @param string $path
	 * @param string $url URL of asset ex/: _assets/css/style.css
	 */
	public function __construct($path, $url)
	{
		$this->path = $path;
		$this->url = $url;
	}

	/**
	 * Set url for Asset
	 *
	 * @param $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Get URL of asset
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set path for Asset
	 *
	 * @param $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * Set path for Asset
	 *
	 * @param $path
	 */
	public function getPath()
	{
		return $this->path;
	}
}