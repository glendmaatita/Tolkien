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

	/**
	 * @var Boolean
	 */
	private $with_draft;

	/**
	 * Construct
	 *
	 * @param array $config
	 * @param Parser $parser
	 */
	public function __construct($config, $parser, $with_draft = false)
	{
		$this->config = $config;
		$this->parser = $parser;
		$this->with_draft = $with_draft;
	}

	/**
	 * Set extracted metadata to Post object and put into array $posts
	 *
	 * @return void
	 */
	public function build()
	{
		$this->find_all_files($this->config['dir']['post']); // get all post files under _posts/		
	}	

	/**
	 * Find All file on post's dir (_posts/) and create array of Model\Post
	 *
	 * @param string $dir
	 * @return recursive
	 */
	public function find_all_files($dir) 
	{
		$root = array_reverse(scandir($dir));
		if(count($root) == 0) return;
		
		foreach($root as $value)
		{
			if($value === '.' || $value === '..')
			{
				continue;
			}
			if(is_file("$dir/$value"))
			{
				$result[] = "$dir/$value";
				$this->posts[] = $this->read( "$dir/$value", $value );
				continue;
			}
			foreach($this->find_all_files("$dir/$value") as $value)
			{
				$result[] = $value;
			}
		}
		return $result;
	} 
	
	/**
	 * Read Meta data from post file under _posts/
	 * Post file structure
	 * ---
	 * type: post
	 * layout: __layout__ default is post (_layouts/post.html.tpl). Create your own layout ! 
	 * title: __your_post_title__
	 * date: __date__ generated. you should not change this
	 * author: __author_name__
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
				// get header
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

		// if type is draft, then continue loop. Not build draft post
		if($header['type'] == 'draft' && !$this->with_draft)
			return;

		$body_excerpt = explode("[more]", $body);
		if(count($body_excerpt) == '2')
		{
			$excerpt = rtrim($body_excerpt[0]);
			$body = rtrim($body_excerpt[0]) . rtrim($body_excerpt[1]);
		}

		$post = new Post( $file, $header['title'], $this->setBody($file, $body), $header['featuredImage'], $this->defineAuthor($header), $this->defineCategories($header) );

		$post->setPublishDate($header['dateFormat']);
		$post->setUrl($header['date'], $header['url']);
		$post->setLayout($header['layout']);
		$post->setPath($path);

		if(isset($excerpt))
			$post->setExcerpt($this->setBody($file, $excerpt));

		// set keywords & summary if exists
		$post->setKeywords(isset($header['keywords']) ? $header['keywords'] : '');
		$post->setSummary(isset($header['summary']) ? $header['summary'] : '');

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
		$author = $this->config['authors'][$header['author']];
		return new Author($header['author'], $author['name'], $author['email'], $author['signature'], $author['facebook'], $author['twitter'], $author['github']);
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
	public function getNodes()
	{
		return array_values(array_filter($this->posts));
	}
}