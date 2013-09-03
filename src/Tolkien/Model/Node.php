<?php namespace Tolkien\Model;

abstract class Node
{
	protected $file;
	protected $title;
	protected $body;
	protected $url;
	protected $layout;

	public function getFileName()
	{

		$file = explode('.', $this->file);
		$pop = array_pop($file);
		return implode('.', $file);
	}
}