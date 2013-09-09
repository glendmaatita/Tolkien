<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienCompileSiteTest extends \PHPUnit_Framework_TestCase
{
	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->init->create();
	}

	public function testCompileSite()
	{
		$pages = array();
		$posts = array();
		$assets = array();

		$pages[] = new Page('contact.markdown', 'Contact to our corp', 'Contact Body');
		$pages[] = new Page('about.markdown', 'About Page', 'About Body');
		$pages[] = new Page('portofolio.markdown', 'Portofolio', 'Portofolio Body');

		$author = new Author('Glend Maatita', 'glend@beenarylab.com', 'Glend Maatita', '@glend_maatita', 'glendmaatita');
		$categories = array(new Category('News'), new Category('Tutorial') );

		$posts[] = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $author, $categories);
		$posts[] = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $author, $categories);

		$site = new Site( $url = 'http://localhost/blog/', $title = 'My Another Blog', $tagline = 'My Blog My Way', $posts, $pages, $assets );

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . '/config.yml' ));

		$loader = new \Twig_Loader_Filesystem( $this->config['dir']['layout'] );
		$twig = new \Twig_Environment($loader));

		$compiler = new CompileSite

	}		
}