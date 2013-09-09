<?php namespace Tolkien\Model;

class TolkienModelPageTest extends \PHPUnit_Framework_TestCase
{

	public function testPageAttributes()
	{
		$page = new Page($file = 'learn-kohana.markdown', $title = 'How to learn Kohana', $body = 'Example Body');

		$this->assertClassHasAttribute('file', 'Tolkien\Model\Page');
		$this->assertClassHasAttribute('title', 'Tolkien\Model\Page');
		$this->assertClassHasAttribute('body', 'Tolkien\Model\Page');

		$this->assertEquals($file, $page->getFile());
		$this->assertEquals($title, $page->getTitle());
		$this->assertEquals($body, $page->getBody());

		$page->setUrl();
		$this->assertEquals( 'learn-kohana.html', $page->getUrl());
	}
}