<?php namespace Tolkien;


interface BuildNode
{
	/**
	 * Extract metadata from post file in folder __posts
	 * @return array Model\Post 
	 */
	public function build();
	public function getNodes();
}