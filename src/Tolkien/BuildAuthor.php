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
	private $author_config;

	/**
	 * Construct
	 *
	 * @param array $author
	 * @param array(Model\Post)
	 */
	public function __construct($author_config, $posts)
	{
		$this->author_config = $author_config;
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

	public function setAuthors($post)
	{
		$username = $post->getAuthor()->getUsername();

		if(in_array($username, array_keys($this->author_config)))
		{
			if(in_array($username, $this->authorsName))
			{
				$this->authors[$username]->setPost($post);
			}
			else 
			{
				$this->authors[$username] = new Author($username, $this->author_config[$username]['name'], $this->author_config[$username]['email'], $this->author_config[$username]['facebook'], $this->author_config[$username]['twitter'], $this->author_config[$username]['github']);
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