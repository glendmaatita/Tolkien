<?php namespace Tolkien;

use Tolkien\Model\Post;
use Tolkien\Model\Author;
use Tolkien\Model\Category;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

/**
 * Extract Meta data from post file under _posts/
 */
class BuildPost implements BuildNode
{

	/**
	 * @var array $config Result from parsing config.yml
	 */
	private $config;

	/**
	 * @var array(Model\Post) $posts 
	 */
	private $posts = array();

	/**
	 * @var Parser $parser Symfony YAML Parser
	 */
	private $parser;

	private $result;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param Parser $parser
	 */
	public function __construct($config, $parser)
	{
		$this->config = $config;
		$this->parser = $parser;
	}

	/**
	 * Set extracted metadata to Post object and put into array $posts
	 *
	 * @return void
	 */
	public function build()
	{
		$this->posts = $this->find_all_files($this->config['dir']['post']); // get all post files under _posts/		
	}	

	public function find_all_files($dir) 
	{ 
    $root = scandir($dir); 
    foreach($root as $value) 
    { 
        if($value === '.' || $value === '..') 
        {
        	continue;
        } 
        if(is_file("$dir/$value")) 
        {
        	$this->result[] = $this->read( "$dir/$value", $value );
        	continue;
        } 
        foreach($this->find_all_files("$dir/$value") as $value) 
        {
            $this->result[] = $this->read( "$dir/$value", $value );
        } 
    } 

    return $this->result; 
	} 
	
	/**
	 * Read Meta data from post file under _posts/
	 * Post file structure
	 * ---
	 * type: post
	 * layout: __layout__ default is post (_layouts/post.html.tpl). Create your own layout ! 
	 * title: __your_post_title__
	 * date: __date__ generated. you should not change this
	 * author:
	 *   name: __your_name__
	 *   email: __your_email__
	 *   facebook: __your_facebook__
	 *   twitter: __your_twitter__
	 *   github: __your_github__
	 *   signature: __signature__
	 * categories: __categories__  Semicolon separated, example category_1, category_2, category_3
	 * ---
 	 *
 	 * [__body__] markdown or html format
 	 *
 	 * @param string $path post file path. Must be _/posts/xyz.markdown
 	 * @param string $file File Name
 	 * @return Model\Post $post
 	 */
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
		$post->setPath($path);

		return $post;
	}

	/**
	 * Set body of Post. If body is markdown text formatted, then it must be transform first to HTML
	 * 
	 * @param string $file file name
	 * @param string $body
	 * @return string $body
	 */
	public function setBody($file, $body)
	{
		if(array_pop(explode('.', $file)) == 'markdown')
			return Markdown::defaultTransform($body);
		else
			return $body;
	}

	/**
	 * Create new Author object instance for Post object
	 *
	 * @param array $header Metadata
	 * @return Model\Author
	 */
	public function defineAuthor($header)
	{
		return new Author($header['author']['name'], $header['author']['email'], $header['author']['signature'], $header['author']['facebook'], $header['author']['twitter'], $header['author']['github']);
	}

	/**
	 * Create a list of category from header metadata
	 *
	 * @param array $header
	 * @return array(Model\Category)
	 */
	public function defineCategories($header)
	{
		$categories = array();
		$cats = explode(',', $header['categories']);
		foreach ($cats as $category) 
		{
			$categories[] = new Category(trim($category));
		}
		return $categories;
	}

	/**
	 * Get all posts
	 *
	 * @return array(Model\Posts)
	 */
	public function getPosts()
	{
		return $this->posts;
	}
}