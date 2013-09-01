<?php namespace Tolkien;

class BuildPost
{
	private $config;
	private $posts;
	private $draft;

	public function __construct($config, $posts = array(), $draft = false)
	{
		$this->config = $config;
		$this->posts = $posts;
		$this->draft = $draft;
	}

	public function build()
	{
		// cleaning assets dir first
		$this->cleanSitesFolder();
		$this->generateSite();
		
	}

	public function cleanSitesFolder()
	{
		// get all file names
		if($this->draft)
			$files = glob( $this->config['dir']['site_draft'] . '/*'); 
		else
			$files = glob( $this->config['dir']['site'] . '/*'); 

		foreach($files as $file){ // iterate files
  	if(is_file($file))
    	unlink($file); // delete file
		}
	}

	public function generateSite()
	{
		if(count($this->posts) > 0)
		{
			foreach ($posts as $post) {
				$this->createSiteFile($post);
			}
		}
		else 
		{
			if($this->draft)
				$dir = $this->config['dir']['draft'];
			else
				$dir = $this->config['dir']['post'];
			
			$files = scandir( $dir ); 
			foreach($files as $file){ // iterate files
		  	if(is_file( $dir . '/' . $file))
		    	$this->createSiteFile($file);
			}
		}
	}

	public function createSiteFile($file)
	{
		if($this->draft)
			file_put_contents( $this->config['dir']['site_draft'] . '/' . $file, "" );
		else
			file_put_contents( $this->config['dir']['site'] . '/' . $file, "" );
	}
}