<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\Author;
use Tolkien\Model\Category;
use Symfony\Component\Yaml\Parser;

class TolkienBuildAuthorTest extends \PHPUnit_Framework_TestCase
{

	public function testBuildCategory()
	{

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml' ));

		$categories_1 = array(new Category('News'), new Category('Tutorial') );
		$categories_2 = array(new Category('Note'), new Category('tutoriaL') );

		$author = new Author($username = 'tolkien', $name = 'Glend Maatita', $email = 'glend@beenarylab.com', $facebook = 'Glend Maatita', $twitter = '@glend_maatita', $github = 'glendmaatita');


		$posts[0] = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $author, $categories_1);
		$posts[1] = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $author, $categories_2);

		$buildAuthor = new BuildAuthor($config, $posts);
		$buildAuthor->build();

		$authors = $buildAuthor->getNodes();

		$this->assertTrue(is_array($authors));
		$this->assertEquals(2, count($authors['tolkien']->getPosts()));
	}
}