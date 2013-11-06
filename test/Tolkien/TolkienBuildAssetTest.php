<?php namespace Tolkien;

use Symfony\Component\Yaml\Parser;

class TolkienBuildAssetTest extends \PHPUnit_Framework_TestCase
{

	public function __construct()
	{
		$this->init = new Init('blog');
		$this->rrmdir( ROOT_DIR );
		$this->init->create();
	}

	public function testBuildAsset()
	{
		$parser = new Parser();
		$config = $parser->parse(file_get_contents( ROOT_DIR . 'config.yml' ));

		$buildAsset = new BuildAsset($config, $parser);
		$buildAsset->build();

		$this->assertTrue(is_array($buildAsset->getNodes()));

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