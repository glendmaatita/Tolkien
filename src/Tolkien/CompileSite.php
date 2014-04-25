<?php namespace Tolkien; 

use Intervention\Image\Image;

/**
 * Generate static site from nodes
 * Use Command : tolkien compile
 */
class CompileSite
{

	/**
	 * @var Tolkien\Model\Site
	 */
	private $site;

	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var Twig_Environment
	 */
	private $twig;

	/**
	 * @var Boolean $with_pagination
	 */
	private $with_pagination;

	/**
	 * Construct
	 *
	 * @param Tolkien\Model\Site $site
	 * @param array $config
	 * @param Twig_Environment $twig
	 */
	public function __construct($site, $config, $twig, $with_pagination = false)
	{
		$this->site = $site;
		$this->config = $config;
		$this->twig = $twig;
		$this->with_pagination = $with_pagination;
	}

	/**
	 * Main function to compile
	 *
	 * @return void
	 */
	public function compile()
	{
		$this->rrmdir($this->config['dir']['site']);
		$this->compilePosts();
		$this->compilePages();
		$this->compileCategories();
		$this->compileAssets();
		// compile pagination if with pagination is true
		if($this->with_pagination) $this->compilePaginations(); 
		$this->compileAuthors();
	}

	/**
	 * Compile Post
	 *
	 * @return void
	 */
	public function compilePosts()
	{
		foreach ($this->site->getPosts() as $post) 
		{			
			$template = $this->twig->loadTemplate( $post->getLayout() . '.html.tpl');
			$content = $template->render(array('site' => $this->site, 'post' => $post ));
			$this->createFile($content, $post);

			// generate featured image
			$this->createFeaturedImage($post);
		}		
	}

	/**
	 * Generate featured image for each size
	 *
	 * @param Model\Post $post
	 * @return void
	 */
	public function createFeaturedImage($post)
	{
		$path = $this->config['dir']['asset'] . $post->getFeaturedImage();
		$save_path = $this->config['dir']['site'] . $post->getFeaturedImage();
		// create dir on absolute path if not exist
		if (!is_dir( dirname($save_path) )) {
			mkdir(dirname($save_path), 0777, true);
		}

		// generate image
		if(null != $post->getFeaturedImageLargeSize()) 
		{
			$size = explode('x', $post->getFeaturedImageLargeSize());
			$this->grabFeaturedImage($path, $size, $save_path, $post->getFeaturedImageLarge());
		}		

		if(null != $post->getFeaturedImageMediumSize())
		{
			$size = explode('x', $post->getFeaturedImageMediumSize());
			$this->grabFeaturedImage($path, $size, $save_path, $post->getFeaturedImageMedium());
		}

		if(null != $post->getFeaturedImageSmallSize()) 
		{			
			$size = explode('x', $post->getFeaturedImageSmallSize());
			$this->grabFeaturedImage($path, $size, $save_path, $post->getFeaturedImageSmall());
		}
	}

	/**
	 * Grab image using Image Intevention
	 *
	 * @param string $path
	 * @param array $size (height,width)
	 * @param string $save_path
	 * @param string $files_save
	 * @return void
	 */
	public function grabFeaturedImage($path, $size, $save_path, $file_save)
	{
		Image::make($path)->grab($size[0], $size[1])->save($this->config['dir']['site'] . $file_save);
	}

	/**
	 * Compile Pages
	 *
	 * @return void
	 */
	public function compilePages()
	{
		foreach ($this->site->getPages() as $page)
		{			
			$template = $this->twig->loadTemplate( $page->getLayout() . '.html.tpl');
			$content = $template->render(array('site' => $this->site, 'page' => $page));
			$this->createFile($content, $page);
		}
	}

	/**
	 * Compile Site Categories
	 *
	 * @return void
	 */
	public function compileCategories()
	{
		foreach ($this->site->getCategories() as $category) 
		{
			if($this->with_pagination)
			{
				foreach ($category->getPaginations() as $cpagination)
				{
					$template = $this->twig->loadTemplate( 'category.html.tpl' );
					$content = $template->render(array('site' => $this->site, 'category' => $category, 'cpagination' => $cpagination));
					$this->createFile($content, $cpagination);
				}
			}			
			else
			{
				$template = $this->twig->loadTemplate( 'category.html.tpl' );
				$content = $template->render(array('site' => $this->site, 'category' => $category));
				$this->createFile($content, $category);
			}
		}
	}

	/**
	 * Compile authors page
	 *
	 * @return void
	 */
	public function compileAuthors()
	{
		foreach ($this->site->getAuthors() as $author) 
		{
			$template = $this->twig->loadTemplate( 'author.html.tpl' );
			$content = $template->render(array('site' => $this->site, 'author' => $author));
			$this->createFile($content, $author);
		}
	}

	/**
	 * Compile Pagination
	 *
	 * @return void
	 */
	public function compilePaginations()
	{
		foreach ($this->site->getPaginations() as $pagination) 
		{
			$template = $this->twig->loadTemplate( 'index.html.tpl' );
			$content = $template->render(array('site' => $this->site, 'pagination' => $pagination));
			$this->createFile($content, $pagination);
		}
	}

	/**
	 * Compile Assets
	 *
	 * @return void
	 */
	public function compileAssets()
	{
		foreach ($this->site->getAssets() as $asset)
		{
			if(!file_exists(dirname($asset->getUrl()) ))
    		mkdir(dirname($asset->getUrl()), 0777, true);

			copy( $asset->getPath(), $asset->getUrl() );
		}
	}

	/**
	 * Create file
	 *
	 * @param string $content
	 * @param Tolkien\Model\Node
	 * @return void
	 */
	public function createFile($content, $node)
	{
		if(!file_exists(dirname($this->config['dir']['site'] . '/' . $node->getUrl())))
    	mkdir(dirname($this->config['dir']['site'] . '/' . $node->getUrl()), 0777, true);

    file_put_contents($this->config['dir']['site'] . '/' . $node->getUrl(), $content);
	}

	/**
	 * Delete all file under _sites folder
	 * 
	 * @return void
	 */
	public function rrmdir($dir) 
	{
		foreach(glob("{$dir}/*") as $file)
		{
			if(is_dir($file)) {
				$this->rrmdir($file);
			} 
			else {
				unlink($file);
			}
		}
		rmdir($dir);
	}
}