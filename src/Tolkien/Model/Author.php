<?php namespace Tolkien\Model;

class Author
{
	private $name;
	private $email;
	private $signature;
	private $facebook;
	private $twitter;
	private $github;

	public function __construct($name, $email, $signature = '', $facebook = '', $twitter = '', $github = '')
	{
		$this->name = $name;
		$this->email = $email;
		$this->signature = $signature;
		$this->facebook = $facebook;
		$this->twitter = $twitter;
		$this->github = $github;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setSignature($signature)
	{
		$this->signature = $signature;
	}

	public function getSignature()
	{
		return $this->signature;
	}

	public function setFacebook($facebook)
	{
		$this->facebook = $facebook;
	}

	public function getFacebook()
	{
		return $this->facebook;
	}

	public function setTwitter($twitter)
	{
		$this->twitter = $twitter;
	}

	public function getTwitter()
	{
		return $this->twitter;
	}

	public function setGithub($github)
	{
		$this->github = $github;
	}

	public function getGithub()
	{
		return $this->github;
	}
}