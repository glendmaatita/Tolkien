<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildDraftTest extends \PHPUnit_Framework_TestCase
{
	private $init;

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );
		$this->init->create();
	}

	public function testBuildDraft()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml' ));

		$draft_1 = new GenerateDraft( $config, array('title' => 'Rails Tutorial', 'type' => 'post') );
		$draft_1->generate();

		$draft_2 = new GenerateDraft( $config, array('title' => 'Kohana Guide', 'type' => 'post') );
		$draft_2->generate();

		$draft_3 = new GenerateDraft( $config, array('title' => 'PHP and My SQL Tuts', 'type' => 'post') );
		$draft_3->generate();

		$buildDraft = new BuildDraft($config, $parser);
		$buildDraft->build();

		$this->assertFileExists( ROOT_DIR . '/_posts/' . Date('Y-m-d') . '-rails-tutorial.markdown');
		$this->assertFileExists( ROOT_DIR . '/_posts/' . Date('Y-m-d') . '-kohana-guide.markdown');
		$this->assertFileExists( ROOT_DIR . '/_posts/' . Date('Y-m-d') . '-php-and-my-sql-tuts.markdown');

		unlink(ROOT_DIR . '/_posts/' . Date('Y-m-d') . '-rails-tutorial.markdown');
		unlink(ROOT_DIR . '/_posts/' . Date('Y-m-d') . '-kohana-guide.markdown');
		unlink(ROOT_DIR . '/_posts/' . Date('Y-m-d') . '-php-and-my-sql-tuts.markdown');
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