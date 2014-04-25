<?php namespace Tolkien\Model;

/**
 * Post is Node with Author, Published Date, excerpt, categories, etc
 */
class Post extends Node
{
	/**
	 * @var DateTime
	 */
	private $publishDate;

	/**
	 * @var DateTime
	 */
	private $updatedDate;

	/**
	 * @var Model\Author
	 */
	private $author;

	/**
	 * Post can have some categories
	 *
	 * @var array(Model\Category)
	 */
	private $categories = array();

	/**
	 * Featured image for Post with original size
	 *
	 * @var String
	 */
	private $featuredImage;

	/**
	 * Featured image for Post with large size
	 *
	 * @var String
	 */
	private $featuredImageLarge;

	/**
	 * Featured image for Post with medium size
	 *
	 * @var String
	 */
	private $featuredImageMedium;

	/**
	 * Featured image for Post with small size
	 *
	 * @var String
	 */
	private $featuredImageSmall;

	/**
	 * Large size of Featured image
	 *
	 * @var String
	 */
	private $featuredImageLargeSize;

	/**
	 * Medium size of featured image
	 *
	 * @var String
	 */
	private $featuredImageMediumSize;

	/**
	 * Small size of featured image
	 *
	 * @var String
	 */
	private $featuredImageSmallSize;

	/**
	 * @var string
	 */
	private $excerpt;

	/**
	 * Construct
	 *
	 * @param string $file File of Post on folder _post/
	 * @param string $title Post's Title
	 * @param string $body Post's Body
	 * @param Model\Author $author Author of Post
	 * @param array(Model\Category) Post's Categories
	 */
	public function __construct($file, $title, $body, $featuredImage = array('original' => '', 'large' => '', 'medium' => '', 'small' => ''), Author $author, $categories = array(), $keywords = array(), $summary = '')
	{
		$this->file = $file;
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->categories = $categories;
		
		$this->featuredImage = $featuredImage['original'];
		$this->featuredImageLarge = $featuredImage['large'];
		$this->featuredImageMedium = $featuredImage['medium'];
		$this->featuredImageSmall = $featuredImage['small'];

		// SEO
		$this->keywords = $keywords;
		$this->summary = $summary;

	}

	/**
	 * Set Author
	 *
	 * @param Model\Author $author
	 */
	public function setAuthor(Author $author)
	{
		$this->author = $author;
	}

	/**
	 * Get Author
	 *
	 * @return Model\Author $author
	 */ 
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Set Published Date. Generated when user create post file in _post/
	 *
	 * Using Date format from native PHP to generate date (see http://www.php.net/manual/en/function.date.php)
	 *
	 * @param string $dateFormat
	 * @return void
	 */
	public function setPublishDate($dateFormat = 'F d, Y')
	{
		$name_separate = explode('-', $this->getFileName(), 4);
		$originalDate = $name_separate[0] . '-' . $name_separate[1] . '-' .$name_separate[2];
		$this->publishDate = date($dateFormat, strtotime($originalDate));
	}

	/**
	 * Get Published Date
	 *
	 * @return string $publishDate
	 */
	public function getPublishDate()
	{
		return $this->publishDate;
	}

	/**
	 * Set array of Categories to Post. Post can have some categories
	 *
	 * @param array(Model\Category) $categories
	 * @return void
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Get Categories of Post
	 *
	 * @return array(Model\Categories) $categories
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Set a Category to Post
	 *
	 * @param Model\Category $category
	 * @return void
	 */
	public function setCategory($category)
	{
		$this->categories[] = $category;
	}

	/**
	 * Get a Category of Post
	 *
	 * @return Category $categories[$key]
	 */
	public function getCategory($key)
	{
		return $this->categories[$key];
	}

	/**
	 * Set Updated Date to Post
	 *
	 * @todo set updated date 
	 */
	public function setUpdatedDate()
	{

	}

	/**
	 * Get Updated Date
	 *
	 * @return string $updatedDate
	 */
	public function getUpdatedDate()
	{
		return $this->updatedDate;
	}

	/**
	 * Set URL to Post
	 *
	 * URL format is set in post file, with such variable that can be used
	 * :date, :month, :year -> taken from date section
	 * :title -> title of file, taken from filename
	 *
	 * @param string $urlFormat
	 * @param string $date
	 * @return void
	 */
	public function setUrl($date, $urlFormat = ':year/:month/:date/:title')
	{
		// $this->url = '/' . implode('/', explode('-', $this->getFileName(), 4)) . '.html';

		$year = date('Y', $date);
		$month = date('m', $date);
		$day = date('d', $date);
		$title = explode('-', $this->getFileName(), 4);

		// replacing variable in the comment above with proper value
		$this->url = '/' . str_replace(array(':date', ':month', ':year', ':title'), array($day, $month, $year, $title[3] . '.html'), $urlFormat);
	}

	/**
	 * Get URL of Post
	 *
	 * @return string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set Excerpt to Post
	 *
	 * @param string $excerpt
	 * @return void
	 */
	public function setExcerpt($excerpt)
	{
		$this->excerpt = $excerpt;
	}

	/**
	 * Get Excerpt of Post
	 *
	 * @return string $excerpt
	 */
	public function getExcerpt()
	{
		return $this->excerpt;
	}

	/**
	 * Set Featured Image
	 *
	 * @param string $featuredImage
	 * @return void
	 */
	public function setFeaturedImage($featuredImage)
	{
		$this->featuredImage = $featuredImage;
	}

	/**
	 * Get featured image
	 *
	 * @return string
	 */
	public function getFeaturedImage()
	{
		return $this->featuredImage;
	}

	/**
	 * Set Featured Image large size
	 *
	 * @param string $featuredImageLarge
	 * @return void
	 */
	public function setFeaturedImageLarge($featuredImageLarge)
	{
		$this->featuredImageLarge = $featuredImageLarge;
	}

	/**
	 * Get featured image large size
	 *
	 * @return string
	 */
	public function getFeaturedImageLarge()
	{
		return $this->featuredImageLarge;
	}

	/**
	 * Set Featured Image medium size
	 *
	 * @param string $featuredImageMedium
	 * @return void
	 */
	public function setFeaturedImageMedium($featuredImageMedium)
	{
		$this->featuredImageMedium = $featuredImageMedium;
	}

	/**
	 * Get featured image medium size
	 *
	 * @return string
	 */
	public function getFeaturedImageMedium()
	{
		return $this->featuredImageMedium;
	}

	/**
	 * Set Featured Image small size
	 *
	 * @param string $featuredImageSmall
	 * @return void
	 */
	public function setFeaturedImageSmall($featuredImageSmall)
	{
		$this->featuredImageSmall = $featuredImageSmall;
	}

	/**
	 * Get featured image small size
	 *
	 * @return string
	 */
	public function getFeaturedImageSmall()
	{
		return $this->featuredImageSmall;
	}

	/**
	 * Set Featured Image type based on their size 
	 *
	 * @array $size
	 * @return void
	 */
	public function setFeaturedImageSize($size)
	{
		if(isset($size['large']))
		{
			$this->setFeaturedImageLargeSize($size['large']);	
		}

		if(isset($size['medium']))
		{
			$this->setFeaturedImageMediumSize($size['medium']);
		}

		if(isset($size['small']))
		{
			$this->setFeaturedImageSmallSize($size['small']);	
		}
	}

  /**
	 * Set large size for featured image
	 *
	 * @param string $featuredImageLargeSize
	 * @return void
	 */
	public function setFeaturedImageLargeSize($featuredImageLargeSize)
	{
		$this->featuredImageLargeSize = $featuredImageLargeSize;
	}

	/**
	 * Get large size of featured image
	 *
	 * @return string
	 */
	public function getFeaturedImageLargeSize()
	{
		return $this->featuredImageLargeSize;
	}

	/**
	 * Set medium size for featured image
	 *
	 * @param string $featuredImageMediumSize
	 * @return void
	 */
	public function setFeaturedImageMediumSize($featuredImageMediumSize)
	{
		$this->featuredImageMediumSize = $featuredImageMediumSize;
	}

	/**
	 * Get medium size of featured image
	 *
	 * @return string
	 */
	public function getFeaturedImageMediumSize()
	{
		return $this->featuredImageMediumSize;
	}

	/**
	 * Set small size for featured image
	 *
	 * @param string $featuredImageSmallSize
	 * @return void
	 */
	public function setFeaturedImageSmallSize($featuredImageSmallSize)
	{
		$this->featuredImageSmallSize = $featuredImageSmallSize;
	}

	/**
	 * Get small size of featured image
	 *
	 * @return string
	 */
	public function getFeaturedImageSmallSize()
	{
		return $this->featuredImageSmallSize;
	}
}