<?php namespace Tolkien\Model;

class TolkienModelCategoryTest extends \PHPUnit_Framework_TestCase
{

	public function testCategoriesAttributes()
	{
		$category = new Category($name = 'News');

		$this->assertClassHasAttribute('name', 'Tolkien\Model\Category');
		$this->assertClassHasAttribute('url', 'Tolkien\Model\Category');

		$this->assertEquals($name, $category->getName());
		$this->assertEquals('/categories/news.html', $category->getUrl());
	}
}