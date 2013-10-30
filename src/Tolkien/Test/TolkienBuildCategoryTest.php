<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\Author;
use Tolkien\Model\Category;

class TolkienBuildCategoryTest extends \PHPUnit_Framework_TestCase
{

	public function testBuildCategory()
	{
		$categories_1 = array(new Category('News'), new Category('Tutorial') );
		$categories_2 = array(new Category('Note'), new Category('tutoriaL') );

		$author = new Author($username = 'entung', $name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita');


		$posts[0] = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $author, $categories_1);
		$posts[1] = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $author, $categories_2);

		$buildCategory = new BuildCategory($posts);
		$buildCategory->build();

		$categories = $buildCategory->getNodes();

		$this->assertTrue(is_array($categories));
		$this->assertEquals( count($categories), 3 );
		$this->assertEquals( count($categories['note']->getPosts()), 1 );
		$this->assertEquals( count($categories['news']->getPosts()), 1 );
		$this->assertEquals( count($categories['tutorial']->getPosts()), 2 );

		$ex_posts = $categories['news']->getPosts();
		$ex_post =$ex_posts[0];
		$this->assertEquals( $ex_post->getTitle(), 'How to learn Kohana' );
	}
}