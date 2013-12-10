<?php namespace Tolkien\Factories;

class TolkienGenerateFactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testGeneratePost()
	{
		//build Post
		$generateFactory = new GenerateFactory( ROOT_DIR . 'config.yml', array(
			'type' => 'post',
			'title' => 'Introduction of PHP 5.4',
			'layout' => 'post',
			'author' => 'entung',
			'categories' => array('category1'),
			'body' => 'Content'
			) );
		$generatePost = $generateFactory->generate();
		$this->assertInstanceOf('Tolkien\GeneratePost', $generatePost);

		$generateFactory = new GenerateFactory( ROOT_DIR . 'config.yml', array(
			'type' => 'page',
			'title' => 'Contact Us',
			'layout' => 'page',
			'author' => 'entung',
			'body' => 'Content'
			) );
		$generatePage = $generateFactory->generate();
		$this->assertInstanceOf('Tolkien\GeneratePage', $generatePage);
	}
}