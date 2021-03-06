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
					)
				->addOption(
					'with-draft', null, InputOption::VALUE_NONE, 'If set, draft posts & pages will be compiled'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if($input->getOption('with-draft'))
			$with_draft = true;
		else
			$with_draft = false;
		
		$output->writeln('<info>Compiling Site ... </info>');
		Tolkien::compile($input->getArgument('name'), $with_draft);
		$output->writeln('<info>Successfully generate static web files. You can find them on <comment>_sites</comment> folder');
	}
}