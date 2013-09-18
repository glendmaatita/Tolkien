<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildPostTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );
		$this->init->create();
	}

	public function testBuildPost()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml' ));

		$post_1 = new GeneratePost( $config, "Latest Android Release Part 1" );
		$post_1->generate();
		$post_2 = new GeneratePost( $config, "Latest Android Release Part 2" );
		$post_2->generate();
		$post_3 = new GeneratePost( $config, "Latest Android Release Part 3" );
		$post_3->generate();
		$post_4 = new GeneratePost( $config, "Latest Android Release Part 4" );
		$post_4->generate();

		$buildPost = new BuildPost($config, $parser);
		$buildPost->build();

		$posts = $buildPost->getPosts();

		$this->assertTrue( is_array($posts) );
		
		$this->assertEquals($posts[0]->getTitle(), 'Latest Android Release Part 1');
		$this->assertEquals($posts[0]->getFile(), Date('Y-m-d') . '-latest-android-release-part-1.markdown');
		$this->assertEquals($posts[0]->getPublishDate(), Date('Y-m-d') );
		$this->assertEquals($posts[0]->getLayout(), 'post' );
		$this->assertEquals($posts[0]->getPath(), basename(realpath(ROOT_DIR)) .'/' . '_posts/' . Date('Y-m-d') . '-latest-android-release-part-1.markdown' );

		$this->assertEquals($posts[1]->getTitle(), 'Latest Android Release Part 2');
		$this->assertEquals($posts[1]->getFile(), Date('Y-m-d') . '-latest-android-release-part-2.markdown');
		$this->assertEquals($posts[1]->getPublishDate(), Date('Y-m-d') );
		$this->assertEquals($posts[1]->getLayout(), 'post' );
		$this->assertEquals($posts[1]->getPath(), basename(realpath(ROOT_DIR)) .'/' . '_posts/' . Date('Y-m-d') . '-latest-android-release-part-2.markdown' );
		
	}

	public function rrmdir($dir) 
	{
		foreach(glob("{$dir}/*") as $file)
    {
        if(is_dir($file)) { 
            $this->rrmdir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dir);
	}
}