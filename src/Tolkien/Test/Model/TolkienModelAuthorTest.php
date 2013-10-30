<?php namespace Tolkien\Model;

use Tolkien\GeneratePost;
use Tolkien\BuildPost;
use Tolkien\Init;
use Symfony\Component\Yaml\Parser;

class TolkienModelAuthorTest extends \PHPUnit_Framework_TestCase
{

	public function testAuthorAttributes()
	{
		$author = new Author($name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita', $posts = array());

		$this->assertClassHasAttribute('name', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('email', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('signature', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('facebook', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('twitter', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('github', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('posts', 'Tolkien\Model\Author');

	}
}