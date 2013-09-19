<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;
use Tolkien\Model\Page;
use Tolkien\Model\Post;
use Tolkien\Model\Author;
use Tolkien\Model\Category;
use Tolkien\Model\Site;
use Tolkien\Model\SiteCategory;

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
		$assets = array();
		$siteCategories = array();

		$page_1 = new Page('contact.markdown', 'Contact to our corp', 'Contact Body');
		$page_1->setLayout('page');
		$page_1->setUrl();
		$page_2 = new Page('about.markdown', 'About Page', 'About Body');
		$page_2->setLayout('page');
		$page_2->setUrl();
		$page_3 = new Page('portofolio.markdown', 'Portofolio', 'Portofolio Body');
		$page_3->setLayout('page');
		$page_3->setUrl();
		$pages = array($page_1, $page_2, $page_3);

		$author = new Author('Glend Maatita', 'glend@beenarylab.com', 'Glend Maatita', '@glend_maatita', 'glendmaatita');
		$categories = array(new Category('News'), new Category('Tutorial') );

		$post_1 = new Post('2013-08-09-learn-kohana.markdown', 'How to learn Kohana', 'Example Body', $author, $categories);
		$post_1->setLayout('post');
		$post_1->setUrl();
		$post_2 = new Post('2013-06-19-rails-tuts.markdown', 'Rails Tutorial', 'Example Body', $author, $categories);
		$post_2->setLayout('post');
		$post_2->setUrl();
		$posts = array($post_1, $post_2);

		$siteCategories = array(new SiteCategory('News', array($post_1, $post_2)));

		$site = new Site( $url = 'http://localhost/blog/', $title = 'My Another Blog', $tagline = 'My Blog My Way', $posts, $pages, $siteCategories, $assets );

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . '/config.yml' ));

		$loader = new \Twig_Loader_Filesystem( $config['dir']['layout'] );
		$twig = new \Twig_Environment($loader);

		$compiler = new CompileSite($site, $config, $twig);
		$compiler->compile();

		$this->assertFileExists( ROOT_DIR . '_sites/' . $page_1->getUrl() );
		$this->assertFileExists( ROOT_DIR . '_sites/' . $page_2->getUrl() );
		$this->assertFileExists( ROOT_DIR . '_sites/' . $page_3->getUrl() );

		$this->assertFileExists( ROOT_DIR . '_sites/' . $post_1->getUrl() );
		$this->assertFileExists( ROOT_DIR . '_sites/' . $post_2->getUrl() );

		$siteCategories = $site->getSiteCategories();
		$this->assertFileExists( ROOT_DIR . '_sites/categories/' . $siteCategories[0]->getName() . '.html');
	}		
}