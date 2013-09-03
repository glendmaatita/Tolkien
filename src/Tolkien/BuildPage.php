<?php namespace Tolkien;

use Tolkien\Model\Page;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

class BuildPage implements BuildNode
{
	private $config;
	private $pages = array();
	private $parser;

	public function __construct($config, $parser)
	{
		$this->config = $config;
		$this->parser = $parser;
	}

	public function build()
	{
		// get all page files under _pages/
		$files = scandir($this->config['dir']['page']);
		foreach ($files as $file) 
		{
			if(is_file( $this->config['dir']['page'] . '/' . $file ))
			{
				$this->pages[] = $this->read( $this->config['dir']['page'] . '/' . $file, $file );
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

		$page = new Page( $file, $header['title'], $body );
		$page->setUrl();
		$page->setLayout($header['layout']);

		return $page;
	}

	public function getPages()
	{
		return $this->pages;
	}
}