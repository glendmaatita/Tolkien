<?php namespace Tolkien\Model;

class TolkienModelCategoryTest extends \PHPUnit_Framework_TestCase
{

	public function testCategoriesAttributes()
	{
		$siteCategory = new Category($name = 'News');

		$this->assertClassHasAttribute('name', 'Tolkien\Model\Category');
		$this->assertClassHasAttribute('url', 'Tolkien\Model\Category');

		$this->assertEquals($name, $siteCategory->getName());
		$this->assertEquals('/categories/news.html', $siteCategory->getUrl());
	}
}