<?php namespace Tolkien;

use Tolkien\Model\Draft;
use Tolkien\Model\Category;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

class BuildDraft implements BuildNode
{
	private $config;
	private $drafts = array();
	private $parser;

	public function __construct($config, $parser)
	{
		$this->config = $config;
		$this->parser = $parser;
	}

	public function build()
	{
		// get all post files under _posts/
		$files = scandir($this->config['dir']['draft']);
		foreach ($files as $file) 
		{
			if(is_file( $this->config['dir']['draft'] . '/' . $file ))
			{
				$this->drafts[] = $this->read( $this->config['dir']['draft'] . '/' . $file, $file );
			}
		}
	}

	public function read($path, $file)
	{
		$content = fopen( $path, "r" );
		$iterator = 1;
		$header_parsed = "";
		$header_parsed_flag = true;
		$body = "";

		while (!feof($content)) 
		{
			if($iterator == 1)
			{
				if( rtrim(fgets($content)) == "---" )
				{
					$iterator++;
					continue;
				}					
				else break;
			}
			else
			{
				$current = rtrim(fgets($content));
				while(  $current != '---' &&  $header_parsed_flag == true)
				{
					$header_parsed .= $current . "\n";
					$iterator++;

					$current = rtrim(fgets($content));
				}

				if($current == '---' && $header_parsed_flag == true )
				{
					$header_parsed_flag = false;
					continue;
				}
				
				$body .= $current . "\n";
			}			
		}

		//parse header
		$header = $this->parser->parse($header_parsed);

		$draft = new Draft( $file, $header['title'], $body, $this->defineAuthor($header), $this->defineCategories($header) );

		$draft->setUrl();
		$draft->setLayout($header['layout']);

		return $draft;
	}

	public function defineAuthor($header)
	{
		return new Author($header['author']['name'], $header['author']['email'], $header['author']['signature'], $header['author']['facebook'], $header['author']['twitter'], $header['author']['github']);
	}

	public function defineCategories($header)
	{
		$categories = array();
		$cats = explode(',', $header['categories']);
		foreach ($cats as $category) 
		{
			$categories[] = new Category($category);
		}
		return $categories;
	}

	public function getDrafts()
	{
		return $this->drafts;
	}
}