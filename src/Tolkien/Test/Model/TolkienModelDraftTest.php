<?php namespace Tolkien\Model;

class TolkienModelDraftTest extends \PHPUnit_Framework_TestCase
{

	public function testDraftAttributes()
	{
		$author = new Author($name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita');

		$categories = array(new Category($name = 'News'), new Category($name = 'Tutorial') );

		$draft = new Draft($file = 'learn-kohana.markdown', $title = 'How to learn Kohana', $body = 'Example Body', $author, $categories);

		$this->assertClassHasAttribute('file', 'Tolkien\Model\Draft');
		$this->assertClassHasAttribute('title', 'Tolkien\Model\Draft');
		$this->assertClassHasAttribute('body', 'Tolkien\Model\Draft');
		$this->assertClassHasAttribute('author', 'Tolkien\Model\Draft');
		$this->assertClassHasAttribute('categories', 'Tolkien\Model\Draft');

		$this->assertEquals($file, $draft->getFile());
		$this->assertEquals($title, $draft->getTitle());
		$this->assertEquals($body, $draft->getBody());
		$this->assertEquals($author, $draft->getAuthor());
		$this->assertEquals($categories, $draft->getCategories());
		$this->assertEquals('learn-kohana', $draft->getFileName());
	}
}