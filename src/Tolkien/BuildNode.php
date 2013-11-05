<?php namespace Tolkien;


interface BuildNode
{
	/**
	 * Extract metadata from post file in folder __posts
	 * @return array Model\Post 
	 */
	public function build();

	/**
	 * Get Nodes : Post, page, authors, categories after build
	 *
	 * @return Model\Node
	 */
	public function getNodes();
}