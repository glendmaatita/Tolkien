<?php namespace Tolkien\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tolkien\Facades\Tolkien;

class ServeCommand extends Command
{
	protected function configure()
	{
		$this->setName('serve')
				->setDescription('Turn on PHP Built in server. You can access your website on http://localhost:3000')
				->addArgument(
					'name', InputArgument::REQUIRED, 'Name of your blog'
					);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<info>Turning on PHP Built-in webserver on port 3000 ... </info>');
		$output->writeln('<info>Successfully serve blog. You can access your blog on </info> <comment>http://localhost:3000</comment>');
		Tolkien::serve($input->getArgument('name'));		
	}
}