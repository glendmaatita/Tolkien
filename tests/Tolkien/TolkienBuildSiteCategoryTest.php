<?php namespace Tolkien;

use Tolkien\Model\Category;
use Tolkien\Model\Post;
use Tolkien\Model\Author;

class TolkienBuildSiteCategoryTest extends \PHPUnit_Framework_TestCase
{

	public function testBuildSiteCategory()
	{
		$categories_1 = array(new Category('News'), new Category('Tutorial') );
		$categories_2 = array(new Category('Note'), new Category('Tutorial') );

		$author = new Author($name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita');


		$posts[0] = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $author, $categories_1);
		$posts[1] = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $author, $categories_2);

		$buildSiteCategory = new BuildSiteCategory($posts);
		$buildSiteCategory->build();

		$siteCategories = $buildSiteCategory->getSiteCategories();

		$this->assertTrue(is_array($siteCategories));
		$this->assertEquals( count($siteCategories), 3 );
		$this->assertEquals( count($siteCategories['Note']->getPosts()), 1 );
		$this->assertEquals( count($siteCategories['News']->getPosts()), 1 );
		$this->assertEquals( count($siteCategories['Tutorial']->getPosts()), 2 );

		$ex_posts = $siteCategories['News']->getPosts();
		$ex_post =$ex_posts[0];
		$this->assertEquals( $ex_post->getTitle(), 'How to learn Kohana' );
	}
}