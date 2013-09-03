<?php namespace Tolkien\Model;

class TolkienModelAuthorTest extends \PHPUnit_Framework_TestCase
{

	public function testAuthorAttributes()
	{
		$author = new Author($name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita');

		$this->assertClassHasAttribute('name', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('email', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('signature', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('facebook', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('twitter', 'Tolkien\Model\Author');
		$this->assertClassHasAttribute('github', 'Tolkien\Model\Author');

	}
}