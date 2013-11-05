<?php namespace Tolkien\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tolkien\Init;

class InitCommand extends Command
{
	protected function configure()
	{
		$this->setName('init')
				->setDescription('Inititialize your blog')
				->addArgument(
					'name', InputArgument::REQUIRED, 'Name of your blog'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<comment>Initializing new blog .. </comment>');
		$init = new Init($input->getArgument('name'));
		$init->create();

		$output->writeln('<info>Successfully create a new blog name </info> <comment>' . $init->getName() . '</comment>');
	}
}