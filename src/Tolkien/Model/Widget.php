<?php namespace Tolkien\Model;

/**
 * Widget is just a piece of code, rendered in your page, post, sidebar, header, etc
 */
class Widget extends Node
{
	/**
	 * Widget extends Node :
	 * - file = filename of widget
	 * - title = widget's title
	 * - body = content of widget
	 */

	public function __construct($file, $title)
	{
		$this->file = $file;
		$this->title = $title;
	}
}