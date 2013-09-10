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


		$posts[] = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $author, $categories_1);
		$posts[] = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $author, $categories_2);

		$buildSiteCategory = new BuildSiteCategory($posts);
		$buildSiteCategory->build();

		$this->assertTrue(is_array($buildSiteCategory->getCategories()));
		$this->assertEquals(3, count($buildSiteCategory->getCategories()));
	}
}