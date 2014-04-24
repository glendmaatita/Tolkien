<?php namespace Tolkien\Model;

class TolkienModelSiteTest extends \PHPUnit_Framework_TestCase
{

	public function testSiteAttributes()
	{
		
		$pages = array();
		$posts = array();
		$assets = array();
		$paginations = array();

		$pages[] = new Page('contact.markdown', 'Contact to our corp', 'Contact Body');
		$pages[] = new Page('about.markdown', 'About Page', 'About Body');
		$pages[] = new Page('portofolio.markdown', 'Portofolio', 'Portofolio Body');

		$author = new Author('Glend Maatita', 'glend@beenarylab.com', 'Glend Maatita', '@glend_maatita', 'glendmaatita');
		$categories = array(new Category('News'), new Category('Tutorial') );

		$posts[] = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $featuredImage = array('original' => '', 'large' => '', 'medium' => '', 'small' => ''), $author, $categories);
		$posts[] = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $featuredImage = array('original' => '', 'large' => '', 'medium' => '', 'small' => ''), $author, $categories);

		$paginations[] = new Pagination(1, 'http://example.org/', $posts, $posts[0], $posts[1]);
		$paginations[] = new Pagination(1, 'http://example.org/', $posts, $posts[0], $posts[1]);

		$assets[] = new Asset('path1', 'url1');
		$assets[] = new Asset('path2', 'url2');

		$site = new Site( $url = 'http://localhost/blog/', $title = 'My Another Blog', $tagline = 'My Blog My Way', $posts, $pages, $categories, $assets, $paginations );
		
		$this->assertClassHasAttribute('url', 'Tolkien\Model\Site');
		$this->assertClassHasAttribute('title', 'Tolkien\Model\Site');
		$this->assertClassHasAttribute('tagline', 'Tolkien\Model\Site');
		$this->assertClassHasAttribute('posts', 'Tolkien\Model\Site');
		$this->assertClassHasAttribute('pages', 'Tolkien\Model\Site');
		$this->assertClassHasAttribute('assets', 'Tolkien\Model\Site');
		$this->assertClassHasAttribute('paginations', 'Tolkien\Model\Site');

		$this->assertEquals($url, $site->getUrl());
		$this->assertEquals($title, $site->getTitle());
		$this->assertEquals($tagline, $site->getTagline());
		$this->assertEquals($posts, $site->getPosts());
		$this->assertEquals($pages, $site->getPages());
		$this->assertEquals($assets, $site->getAssets());
		$this->assertEquals($paginations, $site->getPaginations());
	}
}