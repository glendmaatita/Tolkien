<?php namespace Tolkien\Model;

use Tolkien\Model\Category;

class TolkienModelCategoryTest extends \PHPUnit_Framework_TestCase
{

	public function testCategoryAttributes()
	{
		$category = new Category($name = 'News');

		$this->assertClassHasAttribute('name', 'Tolkien\Model\Category');

		$category->setName('Tutorial');
		$this->assertEquals($category->getName(), 'Tutorial');
	}
}