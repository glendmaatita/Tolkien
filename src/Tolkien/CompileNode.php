<?php namespace Tolkien;

/**
 * Generate static site from nodes
 * Use Command : tolkien compile
 */
Interface CompileNode
{
	public function compile();
}