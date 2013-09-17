<?php namespace Tolkien\Model;

class TolkienModelSiteCategoryTest extends \PHPUnit_Framework_TestCase
{

	public function testSiteCategoriesAttributes()
	{
		$siteCategory = new SiteCategory($name = 'News');

		$this->assertClassHasAttribute('name', 'Tolkien\Model\SiteCategory');
		$this->assertClassHasAttribute('url', 'Tolkien\Model\SiteCategory');

		$this->assertEquals($name, $siteCategory->getName());
		$this->assertEquals('/categories/News.html', $siteCategory->getUrl());
	}
}