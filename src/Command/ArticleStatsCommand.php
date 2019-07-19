<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Return some article stats')
            ->addArgument('id', InputArgument::REQUIRED, 'The article id')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'The output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');

        $data = [
          'id' => $id,
          'hearts' => rand(10, 100)
        ];

        switch($input->getOption('format'))
        {
            case 'text':
                $io->listing($data);
                break;

            case 'json':
                $io->write(json_encode($data));
                break;

            default:
                throw new \Exception('WTF is it?');
        }
    }
}
