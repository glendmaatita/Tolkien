<?php namespace Tolkien;

use Tolkien\Model\Page;
use Michelf\Markdown;
use Symfony\Component\Yaml\Parser;

/**
 * Extract metadata from page file under _pages/
 */
class BuildPage implements BuildNode
{

	/**
	 * @var array $config Result from parsing config.yml
	 */
	private $config;

	/**
	 * @var array(\Model\Page) $pages
	 */
	private $pages = array();

	/**
	 * @var Parser $parser Symfony YAML Parser
	 */
	private $parser;

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
	 * Set extracted metadata to array of Model\Page
	 *
	 * @return void
	 */
	public function build()
	{		
		$files = scandir($this->config['dir']['page']); // get all page files under _pages/
		foreach ($files as $file) 
		{
			if(is_file( $this->config['dir']['page'] . '/' . $file ))
				$this->pages[] = $this->read( $this->config['dir']['page'] . '/' . $file, $file );
		}
	}

	/**
	 * Read Meta data from page file under _pages/
	 * Page file structure
	 * ---
	 * type: page
	 * layout: __layout__ default is page under _layouts/page.html.tpl. You can create your own layout
	 * title: __your_page_layout__
	 * ---
 	 *
 	 * [__body__] markdown or html format
 	 *
 	 * @param string $path page file path. Must be _/pages/xyz.markdown
 	 * @param string $file File Name
 	 * @return Model\Page $page
 	 */
	public function read($path, $file)
	{
		$content = fopen( $path, "r" );
		$iterator = 1;
		$header_parsed = "";
		$header_parsed_flag = true;
		$body = "";

		// read file line by line
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
				// read metadata (header)
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

		$page = new Page( $file, $header['title'], $this->setBody($file, $body) );
		$page->setUrl();
		$page->setLayout($header['layout']);

		return $page;
	}

	/**
	 * Set body of Page. If body is markdown text formatted, then it must be transform first to HTML
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
	 * Get all Pages, ready to render
	 *
	 * @return array(Model\Page) $pages
	 */
	public function getPages()
	{
		return $this->pages;
	}
}