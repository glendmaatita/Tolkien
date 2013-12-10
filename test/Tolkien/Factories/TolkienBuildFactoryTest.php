<?php namespace Tolkien\Factories;

use Tolkien\GeneratePost;
use Tolkien\Init;
use Symfony\Component\Yaml\Parser;

class TolkienBuildFactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testBuildFactory()
	{
		//build Post
		$buildFactory = new BuildFactory( ROOT_DIR . 'config.yml', 'post' );
		$post = $buildFactory->build();
		$this->assertInstanceOf('Tolkien\BuildPost', $post);

		//build Asset
		$buildFactory = new BuildFactory( ROOT_DIR . 'config.yml', 'asset' );
		$asset = $buildFactory->build();
		$this->assertInstanceOf('Tolkien\BuildAsset', $asset);

		//build Page
		$buildFactory = new BuildFactory( ROOT_DIR . 'config.yml', 'page' );
		$page = $buildFactory->build();
		$this->assertInstanceOf('Tolkien\BuildPage', $page);
	}
}