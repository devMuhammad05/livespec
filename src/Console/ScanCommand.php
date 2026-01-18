<?php

namespace Livespec\Livespec\Console;

use Livespec\Livespec\Config\ConfigLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'scan', description: 'Scans the API and verifies agent compatibility')]
class ScanCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Scanning API...');
        // Logic will go here

        $io = new SymfonyStyle($input, $output);
        $io->title('LiveSpec Agent Compatibility Check');

        try {
            // 1. Load config
            $io->section('Loading configuration...');
            $config = new ConfigLoader();
            $io->success('Config loaded');

            // 2. Parse API
            // $io->section('Parsing API specification...');
            // $parser = new OpenApiParser();
            // $apiGraph = $parser->parse($config->getApiSource());
            // $endpointCount = count($apiGraph->getAllEndpoints());
            // $io->success("Found {$endpointCount} endpoints");

            // // 3. Generate specs
            // $io->section('Generating agent-readable specs...');
            // $outputDir = $config->getOutputDir();

            // if (!is_dir($outputDir)) {
            //     mkdir($outputDir, 0755, true);
            // }
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
