<?php namespace Tolkien\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tolkien\Facades\Tolkien;

class CompileCommand extends Command
{
	protected function configure()
	{
		$this->setName('compile')
				->setDescription('Compile sites. It will generate static web files')
				->addArgument(
					'name', InputArgument::REQUIRED, 'Name of your blog'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<info>Compiling Site ... </info>');
		Tolkien::compile($input->getArgument('name'));
		$output->writeln('<info>Successfully generate static web files. You can find them on <comment>_sites</comment> folder');
	}
}