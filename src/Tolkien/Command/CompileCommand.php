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
					)
				->addOption(
					'with-pagination', null, InputOption::VALUE_NONE, 'If set, pages will rendered using paginations variable'
					)
				->addOption(
					'with-sitemap-send', null, InputOption::VALUE_NONE, 'If set, Tolkien will generate sitemap and send to search engines'
					)
				->addOption(
					'with-sitemap', null, InputOption::VALUE_NONE, 'If set, Tolkien will generate sitemap of the web'
					)
				->addOption(
					'with-rss', null, InputOption::VALUE_NONE, 'If set, Tolkien will generate RSS of the web'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if($input->getOption('with-draft'))
			$with_draft = true;
		else
			$with_draft = false;

		if($input->getOption('with-pagination'))
			$with_pagination = true;
		else
			$with_pagination = false;

		$sitemap = false;
		$send = false;

		if($input->getOption('with-sitemap'))
			$sitemap = true;

		if($input->getOption('with-sitemap-send')){
			$sitemap = true;
			$send = true;
		}

		$rss = false;
		if($input->getOption('with-rss')){
			$rss = true;
		}
		
		$output->writeln('<info>Compiling Site ... </info>');
		Tolkien::compile($input->getArgument('name'), $with_draft, $with_pagination, $sitemap, $send, $rss);
		$output->writeln('<info>Successfully generate static web files. You can find them on <comment>_sites</comment> folder');
	}
}