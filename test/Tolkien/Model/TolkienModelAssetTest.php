<?php namespace Tolkien\Model;

class TolkienModelAssetTest extends \PHPUnit_Framework_TestCase
{
	public function testAssetAttributes()
	{
		$asset = new Asset($path = 'assets/css/style.css', $url = '_assets/css/style.css');

		$this->assertClassHasAttribute('path', 'Tolkien\Model\Asset');
		$this->assertClassHasAttribute('url', 'Tolkien\Model\Asset');

		$this->assertEquals($path, $asset->getPath());
		$this->assertEquals($url, $asset->getUrl());
	}
}