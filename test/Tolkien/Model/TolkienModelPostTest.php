<?php namespace Tolkien\Model;

class TolkienModelPostTest extends \PHPUnit_Framework_TestCase
{

	public function testPostAttributes()
	{
		$author = new Author($username = 'entung', $name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita');

		$categories = array(new Category($name = 'News'), new Category($name = 'Tutorial') );

		$post = new Post($file = '2013-08-09-learn-kohana.markdown', $title = 'How to learn Kohana', $body = 'Example Body', $author, $categories);

		$this->assertClassHasAttribute('file', 'Tolkien\Model\Post');
		$this->assertClassHasAttribute('title', 'Tolkien\Model\Post');
		$this->assertClassHasAttribute('body', 'Tolkien\Model\Post');
		$this->assertClassHasAttribute('author', 'Tolkien\Model\Post');
		$this->assertClassHasAttribute('categories', 'Tolkien\Model\Post');

		$this->assertEquals($file, $post->getFile());
		$this->assertEquals($title, $post->getTitle());
		$this->assertEquals($body, $post->getBody());
		$this->assertEquals($author, $post->getAuthor());
		$this->assertEquals($categories, $post->getCategories());
		$this->assertEquals('2013-08-09-learn-kohana', $post->getFileName());
		$this->assertEquals( 'Glend Maatita', $post->getAuthor()->getName());
		$this->assertEquals( 'entung', $post->getAuthor()->getUserName());

		$post->setPublishDate();
		$post->setUrl();
		$this->assertEquals( 'August 09, 2013', $post->getPublishDate());
		$this->assertEquals( '/2013/08/09/learn-kohana.html', $post->getUrl());
	}
}