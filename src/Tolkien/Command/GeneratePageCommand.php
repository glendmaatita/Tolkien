<?php namespace Tolkien\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tolkien\Facades\Tolkien;

class GeneratePageCommand extends Command
{
	protected function configure()
	{
		$this->setName('generate:page')
				->setDescription('Generate New Page')
				->addArgument(
					'name', InputArgument::REQUIRED, 'Name of your blog'
					)
				->addArgument(
					'title', InputArgument::REQUIRED, 'Title of Page'
					)
				->addOption(
					'layout', null, InputOption::VALUE_OPTIONAL, 'Layout for generated Page', 'post'
					)
				->addOption(
					'type', null, InputOption::VALUE_OPTIONAL, 'Fill with Draft if you want create Page Draft', 'page'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<comment>Generating a Page .. </comment>');
		$properties = array(
			'node' => 'page', 'type' => $input->getOption('type'), 'title' => $input->getArgument('title'), 'layout' => $input->getOption('layout'), 'body' => 'Body of Page');
		
		$generate = Tolkien::generate($input->getArgument('name'), $properties);

		$output->writeln('<info>Successfully Generate Page in</info> <comment>' . $generate->setPath($input->getArgument('title'))) . '</comment>';
	}
}