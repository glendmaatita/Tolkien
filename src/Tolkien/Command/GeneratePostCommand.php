<?php namespace Tolkien\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Tolkien\Facades\Tolkien;

class GeneratePostCommand extends Command
{
	protected function configure()
	{
		$this->setName('generate:post')
				->setDescription('Generate New Post')
				->addArgument(
					'name', InputArgument::REQUIRED, 'Name of your blog'
					)
				->addArgument(
					'title', InputArgument::REQUIRED, 'Title of Post'
					)
				->addOption(
					'layout', null, InputOption::VALUE_OPTIONAL, 'Layout for generated Post', 'post'
					)
				->addOption(
					'author', null, InputOption::VALUE_OPTIONAL, 'Author of Post', 'tolkien'
					)
				->addOption(
					'categories', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, 'Categories of Post. Separated by comma', array('category1')
					)
				->addOption(
					'type', null, InputOption::VALUE_OPTIONAL, 'Fill with Draft if you want create Post Draft', 'post'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<comment>Generating a Post .. </comment>');
		
		if(is_array($input->getOption('categories')))
			$categories = $input->getOption('categories');
		else
			$categories = explode(',', $input->getOption('categories'));

		$properties = array(
			'node' => 'post', 
			'type' => $input->getOption('type'), 
			'title' => $input->getArgument('title'), 
			'layout' => $input->getOption('layout'), 
			'author' => $input->getOption('author'), 
			'categories' => $categories,
			'featuredImage' => '',
			'body' => 'Body of Content'
			);
		$generate = Tolkien::generate($input->getArgument('name'), $properties);

		$output->writeln('<info>Successfully Generate Post in</info> <comment>' . $generate->setPath($input->getArgument('title'))) . '</comment>';
	}
}