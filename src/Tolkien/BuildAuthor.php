<?php namespace Tolkien;

use Tolkien\Model\Author;

/**
 * Build Authors
 */
class BuildAuthor implements BuildNode {

	/**
	 * @var array(Model\Post)
	 */
	private $posts = array();
	/**
	 * @var array(Model\Author)
	 */
	private $authors = array();
	/**
	 * @var array
	 */
	private $authorsName = array();
	/**
	 * @var array
	 */
	private $config;

	/**
	 * Construct
	 *
	 * @param array $author
	 * @param array(Model\Post)
	 */
	public function __construct($config, $posts)
	{
		$this->config = $config;
		$this->posts = $posts;
	}

	/**
	 * Build Method implmented from BuildNode Interface
	 *
	 * @return void
	 */
	public function build()
	{
		foreach ($this->posts as $post) 
		{
			$this->setAuthors($post);
		}
	}

	/**
	 * Set Posts on author
	 *
	 * @param Model\Post $post
	 * @return void
	 */
	public function setAuthors($post)
	{
		$username = $post->getAuthor()->getUsername();

		if(in_array($username, array_keys($this->config['authors'])))
		{
			if(in_array($username, $this->authorsName))
			{
				$this->authors[$username]->setPost($post);
			}
			else 
			{
				$this->authors[$username] = new Author($username, $this->config['authors'][$username]['name'], $this->config['authors'][$username]['email'], $this->config['authors'][$username]['facebook'], $this->config['authors'][$username]['twitter'], $this->config['authors'][$username]['github']);
				$this->authors[$username]->setPost($post);
				$this->authorsName[] = $username;	
			}
		}
	}

	/**
	 * Get all authors from build result
	 *
	 * @return Model\Author
	 */
	public function getNodes()
	{
		return $this->authors;
	}
}