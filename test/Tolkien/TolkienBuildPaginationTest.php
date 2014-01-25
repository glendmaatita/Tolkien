<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildPaginationTest extends \PHPUnit_Framework_TestCase
{

	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );		
		$this->init->create();
	}

	public function testBuildPagination()
	{		
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml' ));

		$post_1 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part a" ) );
		$post_1->generate();
		$post_2 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part b" ) );
		$post_2->generate();
		$post_3 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part c" ) );
		$post_3->generate();
		$post_4 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part d" ) );
		$post_4->generate();
		$post_5 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part e" ) );
		$post_5->generate();
		$post_6 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part f" ) );
		$post_6->generate();
		$post_7 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part g" ) );
		$post_7->generate();
		$post_8 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part h" ) );
		$post_8->generate();
		$post_9 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part i" ) );
		$post_9->generate();
		$post_10 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part j" ) );
		$post_10->generate();
		$post_11 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part k" ) );
		$post_11->generate();
		$post_12 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part l" ) );
		$post_12->generate();
		$post_13 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part m" ) );
		$post_13->generate();
		$post_14 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part n" ) );
		$post_14->generate();
		$post_15 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part o" ) );
		$post_15->generate();
		$post_16 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part p" ) );
		$post_16->generate();
		$post_17 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part q" ) );
		$post_17->generate();
		$post_18 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part r" ) );
		$post_18->generate();
		$post_19 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part s" ) );
		$post_19->generate();
		$post_20 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part t" ) );
		$post_20->generate();
		$post_21 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part u" ) );
		$post_21->generate();
		$post_22 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part v" ) );
		$post_22->generate();
		$post_23 = new GeneratePost( $config, $this->prepareProperties("Latest Android Release Part w" ) );
		$post_23->generate();


		$buildPost = new BuildPost($config, $parser);
		$buildPost->build();

		$posts = $buildPost->getNodes();

		$buildPagination = new BuildPagination($config, $posts);
		$buildPagination->build();
		$paginations = $buildPagination->getNodes();

		$this->assertTrue(is_array($paginations));
		$this->assertEquals(10, count($paginations[0]->getPosts()));
		$this->assertEquals(10, count($paginations[1]->getPosts()));
		$this->assertEquals(3, count($paginations[2]->getPosts()));

		$this->assertEquals($paginations[0]->getNextPage(), $paginations[1]);
		$this->assertEquals($paginations[0]->getPreviousPage(), null);
		$this->assertEquals($paginations[1]->getNextPage(), $paginations[2]);
		$this->assertEquals($paginations[1]->getPreviousPage(), $paginations[0]);
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

	public function prepareProperties($title)
	{
		return array(
			'title' => $title,
			'type' => 'post',
			'layout' => 'post',
			'author' => 'tolkien',
			'url' => ':year/:month/:date/:title',
			'categories' => array('category1'),
			'featuredImage' => '',
			'body' => 'Body of Content'
			);
	}
}