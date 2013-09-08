<?php namespace Tolkien\Model;

/**
 * Node is page, post, or something else that has a URL and will be rendered on browser
 */
abstract class Node
{
	protected $file;
	protected $title;
	protected $body;
	protected $url;
	protected $layout;
	protected $path;

	/**
	 * Get File Name without extension
	 * example : index.markdown -> index
	 * 
	 * @return string file name
	 */
	public function getFileName()
	{
		$file = explode('.', $this->file);
		$pop = array_pop($file);
		return implode('.', $file);
	}

	/**
	 * Set File name with extension
	 *
	 * @param string $file
	 * @return void
	 */
	public function setFile($file)
	{
		$this->file = $file;
	}

	/**
	 * Get File name with extension
	 *
	 * @return string file name
	 */
	public function getFile()
	{
		return $this->file;
	}

	/**
	 * Set title of Node
	 *
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Get title of Node
	 *
	 * @return string $title title of Node
	 */
	public function getFile()
	{
		return $this->title;
	}

	/**
	 * Set Body of Node
	 *
	 * @param string $body
	 */
	public function setBody($body)
	{
		$this->body = $body;
	}

	/**
	 * Get body of Node
	 *
	 * @return string $body
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * Set URL for Node
	 *
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Get URL of Node
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set Layout
	 *
	 * @param string $layout
	 */
	public function seLayout($layout)
	{
		$this->layout = $layout;
	}

	/**
	 * Get Layout
	 *
	 * @return string $layout
	 */
	public function getLayout()
	{
		return $this->layout;
	}

	public function setPath($path)
	{
		$this->path;
	}

	public function getPath()
	{
		return $this->path;
	}
}