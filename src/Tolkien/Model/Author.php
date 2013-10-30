<?php namespace Tolkien\Model;

/**
 * Author of the Model\Post
 */
class Author
{
	/**
	 * @var string
	 */
	private $username;
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $signature;

	/**
	 * @var string
	 */
	private $facebook;

	/**
	 * @var string
	 */
	private $twitter;

	/**
	 * @var string
	 */
	private $github;

	/**
	 * @var array(Model\Post)
	 */
	private $posts;

	/**
	 * Construct. Name and email is mandatory
	 *
	 * @param string $username Author's Code Name
	 * @param string $name Author's Name
	 * @param string $email Author's email
	 * @param string $signature Author's signature, description of him
	 * @param string $facebook Author's facebook page/profile
	 * @param string $twitter Author's Twitter Account
	 * @param string $github Author's Github 
	 */
	public function __construct($username, $name, $email, $signature = '', $facebook = '', $twitter = '', $github = '', $posts = array())
	{
		$this->username = $username;
		$this->name = $name;
		$this->email = $email;
		$this->signature = $signature;
		$this->facebook = $facebook;
		$this->twitter = $twitter;
		$this->github = $github;
		$this->posts = $posts;
	}

	/**
	 * Set Username
	 *
	 * @param string $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * Get Author's username
	 *
	 * @return string $username
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set Name
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Get Author's Name
	 *
	 * @return string $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set Author's Name
	 *
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Get Author's Name
	 *
	 * @return string $email
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set Author's Name
	 *
	 * @return string $signature
	 */
	public function setSignature($signature)
	{
		$this->signature = $signature;
	}

	/**
	 * Get Author's Signature
	 *
	 * @return string $signature
	 */
	public function getSignature()
	{
		return $this->signature;
	}

	/**
	 * Set Author's Facebook Account
	 *
	 * @param string $facebook
	 */
	public function setFacebook($facebook)
	{
		$this->facebook = $facebook;
	}

	/**
	 * Get Author's Facebook Account
	 *
	 * @return string $facebook
	 */
	public function getFacebook()
	{
		return $this->facebook;
	}

	/**
	 * Set Author's Twitter Username
	 *
	 * @param string $twitter
	 */
	public function setTwitter($twitter)
	{
		$this->twitter = $twitter;
	}

	/**
	 * Get Author's Twitter Username
	 *
	 * @return string $twitter
	 */
	public function getTwitter()
	{
		return $this->twitter;
	}

	/**
	 * Set Author's Github
	 *
	 * @param string $github
	 */
	public function setGithub($github)
	{
		$this->github = $github;
	}

	/**
	 * Get Author's Github
	 *
	 * @return string $github
	 */
	public function getGithub()
	{
		return $this->github;
	}

	/**
	 * set posts by the author
	 *
	 * @param array(Model\Post)
	 */
	public function setPosts($posts)
	{
		$this->posts = $posts;
	}

	/**
	 * Get all posts by the author
	 *
	 * @return array(Model\Post)
	 */
	public function getPosts()
	{
		return $this->posts;
	}

	/**
	 * Set a post to author's post
	 *
	 * @param Model\Post $post
	 */
	public function setPost($post)
	{
		$this->posts[] = $post;
	}
}