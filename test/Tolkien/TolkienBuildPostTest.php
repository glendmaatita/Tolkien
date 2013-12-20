<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildPostTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function testBuildPost()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );
		$this->init->create();

		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml' ));

		$post_1 = new GeneratePost( $config, $this->prepareProperties( "Latest Android Release Part 1" ) );
		$post_1->generate();
		$post_2 = new GeneratePost( $config, $this->prepareProperties( "Latest Android Release Part 2" ) );
		$post_2->generate();
		$post_3 = new GeneratePost( $config, $this->prepareProperties( "Latest Android Release Part 3" ) );
		$post_3->generate();
		$post_4 = new GeneratePost( $config, $this->prepareProperties( "Latest Android Release Part 4 (revised)" ) );
		$post_4->generate();

		// draft
		$post_5 = new GeneratePost( $config, $this->prepareProperties( "Draft - Latest Android Release Part 5", 'draft' ) );
		$post_5->generate();		

		// with no draft
		$buildPost = new BuildPost($config, $parser, $with_draft = false);
		$buildPost->build();
		$posts = $buildPost->getNodes();

		$this->assertTrue( is_array($posts) );
		$this->assertEquals(4, count($posts));

		// with draft
		$buildPost = new BuildPost($config, $parser, $with_draft = true);
		$buildPost->build();
		$posts = $buildPost->getNodes();
		$this->assertEquals(5, count($posts));

		$name_separate = explode('-', Date('Y-m-d'));
		$originalDate = $name_separate[0] . '-' . $name_separate[1] . '-' .$name_separate[2];
		$publishDate = date("F d, Y", strtotime($originalDate));
		
		$this->assertEquals($posts[0]->getTitle(), 'Latest Android Release Part 4 (revised)');
		$this->assertEquals($posts[0]->getFile(), Date('Y-m-d') . '-latest-android-release-part-4-revised.markdown');
		$this->assertEquals($posts[0]->getPublishDate(), $publishDate );
		$this->assertEquals($posts[0]->getLayout(), 'post' );
		$this->assertEquals($posts[0]->getPath(), basename(realpath(ROOT_DIR)) .'/' . '_posts/' . Date('Y-m-d') . '-latest-android-release-part-4-revised.markdown' );

		$this->assertEquals($posts[1]->getTitle(), 'Latest Android Release Part 3');
		$this->assertEquals($posts[1]->getFile(), Date('Y-m-d') . '-latest-android-release-part-3.markdown');

		$this->assertEquals($posts[1]->getPublishDate(), $publishDate );
		$this->assertEquals($posts[1]->getLayout(), 'post' );
		$this->assertEquals($posts[1]->getPath(), basename(realpath(ROOT_DIR)) .'/' . '_posts/' . Date('Y-m-d') . '-latest-android-release-part-3.markdown' );
		
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

	public function prepareProperties($title, $type = 'post')
	{
		return array(
			'title' => $title,
			'type' => $type,
			'layout' => 'post',
			'author' => array(
				'name' => 'Your Name',
				'email' => 'Your Email',
				'facebook' => 'Your Facebook',
				'twitter' => 'Your Twitter',
				'github' => 'Your Github',
				'signature' => 'Your Signature',			
				),
			'categories' => array('category1'),
			'body' => 'Body of Content'
			);
	}
}