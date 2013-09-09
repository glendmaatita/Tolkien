<?php namespace Tolkien;

use Tolkien\Model\Draft;
use Tolkien\Model\Category;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

/**
 * Make all files under _drafts/ become post file in _posts/
 */
class BuildDraft implements BuildNode
{

	/**
	 * @var array $config from config.yml
	 */
	private $config;

	/**
	 * @var array $files All files on folder _drafts/
	 */
	private $files = array();

	/**
	 * @var Symfony\Component\Yaml\Parser $parser YAML parser from Symfony
	 */
	private $parser;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param Parser $parse
	 */
	public function __construct($config, $parser)
	{
		$this->config = $config;
		$this->parser = $parser;
	}

	/**
	 * Generate a post file from draft and put it on folder _posts/
	 */
	public function build()
	{		
		$this->find_all_files($this->config['dir']['draft']); // get all post files under _drafts/		
	}
	
	public function find_all_files($dir)
	{
		$root = scandir($dir);		
    foreach($root as $value) 
    { 
      if($value === '.' || $value === '..')
      	continue;

      if(is_file("$dir/$value")) 
      {
      	$draft = explode('.', $value);
				$ext = array_pop($draft);

				if( $ext == 'post')
					$this->generatePost(implode('.', $draft), $value);
				else if( $ext == 'page')
					$this->generatePage(implode('.', $draft), $value);
				else
					return;

      	continue;
      }

      foreach(find_all_files("$dir/$value") as $value) 
      {
         if( $ext == 'post')
					$this->generatePost(implode('.', $draft), $value);
				else if( $ext == 'page')
					$this->generatePage(implode('.', $draft), $value);
				else
					return;
      } 
    }
	}

	/**
	 * Create a post file from draft into folder _posts/ with same name
	 */
	public function generatePost($draft, $file)
	{
		file_put_contents( $this->config['dir']['post'] . '/' . Date('Y-m-d') . '-' . $draft, file_get_contents( $this->config['dir']['draft'] . '/' . $file));
	}

	/**
	 * Create a page file from draft into folder _pages/ with same name
	 */
	public function generatePage($draft, $file)
	{
		file_put_contents( $this->config['dir']['page'] . '/' . $draft, file_get_contents( $this->config['dir']['draft'] . '/' . $file));
	}
}