<?php namespace Tolkien;

use \Sonrisa\Component\Sitemap\Sitemap;
use \Sonrisa\Component\Sitemap\NewsSitemap;
use \Sonrisa\Component\Sitemap\ImageSitemap;
use \Sonrisa\Component\Sitemap\IndexSitemap;
use \Sonrisa\Component\Sitemap\Items\UrlItem;
use \Sonrisa\Component\Sitemap\Items\NewsItem;
use \Sonrisa\Component\Sitemap\Items\ImageItem;
use \Sonrisa\Component\Sitemap\Items\IndexItem;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException;
use \Sonrisa\Component\Sitemap\SubmitSitemap;

/**
 * Generate Sitemap for all Nodes (Post & Page, Categories page) of the site
 */
class GenerateSitemap {

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

	/**
	 * Main Method of this class. Calling all generating method
	 * Generate index sitemap for all generated sitemap
	 * 
	 * @return void
	 */
	public function generate()
	{
		try{
			// generate index sitemap
			$sitemap = new IndexSitemap;

			$this->generatePageSitemap($this->site->getPages());
			$item = new IndexItem;
			$item->setLoc($this->config['config']['url'] . '/sitemap.page.xml');
			$item->setLastMod(date(DATE_ATOM, strtotime(date('Y-m-d H:i:s'))) );
			$sitemap->add($item);

			$this->generatePostSitemap($this->site->getPosts());
			$item = new IndexItem;
			$item->setLoc($this->config['config']['url'] . '/sitemap.post.xml');
			$item->setLastMod(date(DATE_ATOM, strtotime(date('Y-m-d H:i:s'))) );
			$sitemap->add($item);

			$this->generateCategorySitemap($this->site->getCategories());
			$item = new IndexItem;
			$item->setLoc($this->config['config']['url'] . '/sitemap.category.xml');
			$item->setLastMod(date(DATE_ATOM, strtotime(date('Y-m-d H:i:s'))) );
			$sitemap->add($item);

			$this->generateImageSite($this->site->getPosts());
			$item = new IndexItem;
			$item->setLoc($this->config['config']['url'] . '/sitemap.image.xml');
			$item->setLastMod(date(DATE_ATOM, strtotime(date('Y-m-d H:i:s'))) );
			$sitemap->add($item);
			$sitemap->write($this->config['dir']['site'] . '/sitemap.index.xml')

		} catch(SitemapException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * Generate Sitemap for page, including for homepage
	 *
	 * @param array(Tolkien\Model\Page)
	 * @return void
	 */
	public function generatePageSitemap($pages)
	{
		$sitemap = new Sitemap();		
		foreach ($pages as $page) 
		{
			$item = new UrlItem();
			$item->setLoc($this->config['config']['url'] . '/' . $page->getUrl());
			$item->setLastMod(date(DATE_ATOM, strtotime(date('Y-m-d H:i:s'))) );

			$sitemap->add($time);
		}
		$sitemap->write($this->config['dir']['site'] . '/sitemap.page.xml')
	}

	/**
	 * Generating sitemap for posts = sitemap for news
	 *
	 * @param array(Tolkien\Model\Post)
	 * @return void
	 */
	public function generatePostSitemap($posts)
	{
		$sitemap = new NewsSitemap();
		foreach ($posts as $post) {
			$item->setLoc($this->config['config']['url'] . '/' . $post->getUrl());
			$item->setTitle($post->getTitle());
			$item->setPublicationDate($post->getPublishDate());
			$item->setPublicationName('Blog of Kampus.co.id');
			$item->setPublicationLanguage('id');

			// optionals
			if($post->getKeywords() != '')
				$item->setKeywords($post->getKeywords());

			// set categories as genres
			$categories = array();
			foreach ($post->getCategories() as $category) {
				$categories[] = $category->getName();
			}
			$item->setGenres(implode(',', $categories));

			// add to sitemap
			$sitemap->add($item);
		}
		$sitemap->write($this->config['dir']['site'] . '/sitemap.post.xml')
	}

	/**
	 * Generate sitemap for category page
	 *
	 * @param array(Tolkien\Model\Category)
	 * @return void
	 */
	public function generateCategorySitemap($categories)
	{
		$sitemap = new Sitemap;
		foreach ($categories as $category) {
			$item = new UrlItem;
			$item->setLoc($this->config['config']['url'] . '/' . $category->getUrl());
			$item->setLastMod(date(DATE_ATOM, strtotime(date('Y-m-d H:i:s'))) );

			$sitemap->add($item);
		}
		$sitemap->write($this->config['dir']['site'] . '/sitemap.category.xml')
	}

	/**
	 * Generate sitemap for image on post. Mainly for SEO purpose
	 *
	 * @param array(Tolkien\Posts)
	 * @return void
	 */
	public function generateImageSite($posts)
	{
		$sitemap = new ImageSitemap;
		foreach ($posts as $post) {
			if($post->getFeaturedImage() != '')
			{
				$item = new ImageItem;
				$item->setLoc($this->config['config']['url'] . $post->getFeaturedImage());
				$item->setTitle($post->getTitle());

				$sitemap->add($item, $this->config['config']['url']);
			}
		}
		$sitemap->write($this->config['dir']['site'] . '/sitemap.image.xml')
	}

	/**
	 * Send to search engine
	 *
	 * @return Boolean
	 */
	public function send()
	{
		$status = SubmitSitemap::send('http://example.com/sitemap-index.xml');
		return $status['google'] && $status['bing'];
	}
}