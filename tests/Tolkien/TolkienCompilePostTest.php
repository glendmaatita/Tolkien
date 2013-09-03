<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienCompilePostTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->init->create();
	}

	public function testCompilePost()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'blog' . '/config.yml' ));

		$build_post = new BuildPost($config, $parser);
		$build_post->build();
		$posts = $build_post->getPosts();

		$compile_post = new CompilePost($config, $posts);
		$compile_post->compile();
	}		
}