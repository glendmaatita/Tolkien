<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\Author;
use Tolkien\Model\Category;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

class BuildPost implements BuildNode
{
	private $config;
	private $posts = array();
	private $parser;

	public function __construct($config, $parser)
	{
		$this->config = $config;
		$this->parser = $parser;
	}

	public function build()
	{
		// get all post files under _posts/
		$files = scandir($this->config['dir']['post']);
		foreach ($files as $file) 
		{
			if(is_file( $this->config['dir']['post'] . '/' . $file ))
			{
				$this->posts[] = $this->read( $this->config['dir']['post'] . '/' . $file, $file );
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

		$post = new Post( $file, $header['title'], $this->setBody($file, $body), $this->defineAuthor($header), $this->defineCategories($header) );

		$post->setPublishDate();
		$post->setUrl();
		$post->setLayout($header['layout']);

		return $post;
	}

	public function setBody($file, $body)
	{
		if(array_pop(explode('.', $file)) == 'markdown')
			return Markdown::defaultTransform($body);
		else
			return $body;
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

	public function getPosts()
	{
		return $this->posts;
	}
}