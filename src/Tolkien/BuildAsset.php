<?php namespace Tolkien;

use Tolkien\Model\Asset;

/**
 * Build Asset is copying all files under _assets/ to _site/
 */
class BuildAsset
{
	/**
	 * @var array Config, parsed from config.yml
	 */
	private $config;

	/**
	 * @var array(Model\Asset)
	 */
	private $assets;

	/**
	 * @var Parser Symfony YML Parser
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
	 * Set asset properties
	 *
	 * @return void
	 */
	public function build()
	{
		$this->assets = $this->find_all_files($this->config['dir']['asset']);  // get all page files under _pages/
	}

	/**
	 * Find All file on asset dir and create array of Model\Asset
	 *
	 * @param string $dir
	 * @return void
	 */
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
	        	$result[]="$dir/$value";
	        	continue;
	        } 
	        foreach($this->find_all_files("$dir/$value") as $value) 
	        {
	            $result[]=$value; 
	        } 
	    } 
	    return $result; 
	} 

	/**
	 * Create Asset object instance
	 *
	 * @param string $path
	 * @return Model\Asset
	 */
	public function setAsset($path)
	{
		$url = explode('/', $path);
		array_shift($url);

		return new Asset($path, '/' . $url);
	}

	/**
	 * Get all asset
	 *
	 * @return array Model\Asset
	 */
	public function getAssets()
	{
		return $this->assets;
	}
}