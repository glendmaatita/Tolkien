<?php namespace Tolkien;

use \Suin\RSSWriter\Feed;
use \Suin\RSSWriter\Channel;
use \Suin\RSSWriter\Item;

/**
 * Generate Sitemap for all Nodes (Post & Page, Categories page) of the site
 */
class GenerateRss {

	/**
	 * @var Tolkien\Model\Site
	 */
	private $site;

	/**
	 * @var array $config Result parsing from config.yml
	 */
	private $config = array();

	/**
	 * @param Tolkien\Model\Site $site
	 * @param array $config
	 */
	public function __construct($site, $config)
	{
		$this->site = $site;
		$this->config = $config;
	}

	public function generate()
	{
		try{
			// generate main feed
			$feed = new Feed;

			// site channel
			$siteChannel = new Channel;
			$siteChannel->title($this->config['config']['title'])
				->description($this->config['config']['tagline'])
				->url($this->config['config']['url'])
				->appendTo($feed);

			$this->generatePageRss($siteChannel); // page rss
			$this->generateCategoryRss($siteChannel); //category rss

			//category channel
			foreach ($this->site->getCategories() as $category) {
				$categoryChannel = new Channel;
				$categoryChannel->title($category->getName())
					->description($category->getName())
					->url($category->getUrl())
					->appendTo($feed);

				foreach ($category->getPosts() as $post) {
					$item = new Item;
					$item->title($post->getTitle())
						->description($post->getExcerpt())
						->url($post->getUrl())
						->appendTo($categoryChannel);
				}
			}

			// author channel
			foreach ($this->site->getAuthors() as $author) {
				$authorChannel = new Channel;
				$authorChannel->title($author->getName())
					->description($author->getName())
					->url($author->getUrl())
					->appendTo($feed);

				foreach ($author->getPosts() as $post) {
					$item = new Item;
					$item->title($post->getTitle())
						->description($post->getExcerpt())
						->url($post->getUrl())
						->appendTo($authorChannel);
				}
			}

			file_put_contents($this->config['dir']['site'] .'/rss.xml', $feed);

		} catch(SitemapException $e) {
			echo $e->getMessage();
		}
	}

	public function generatePageRss($channel)
	{
		foreach($this->site->getPages() as $page) {
			$item = new Item;
			$item->title($page->getTitle())
				->description($page->getTitle())
				->url($page->getUrl())
				->appendTo($channel);
		}
	}

	public function generateCategoryRss($channel)
	{
		foreach($this->site->getCategories() as $category) {
			$item = new Item;
			$item->title($category->getName())
				->description($category->getName())
				->url($category->getUrl())
				->appendTo($channel);
		}
	}
}