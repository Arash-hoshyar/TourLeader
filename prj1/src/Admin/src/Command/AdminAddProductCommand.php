<?php

declare(strict_types=1);

namespace Admin\Command;


use Admin\DB\product\ProductGateWay;
use phpDocumentor\Reflection\Types\AbstractList;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdminAddProductCommand extends Command
{
    private ContainerInterface $container;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('csv');

        $output->writeln('this means success my Friend');

        $realPath = realpath($filename);
        $output->writeln($filename);
        $csvFileOutput = $this->openCsv($filename);
        var_dump($realPath);
        die();

        /** @var ProductGateWay $productGateway */
        $productGateway = $this->container->get(ProductGateway::class);

        foreach ($csvFileOutput as $productArray) {
            var_dump($productArray);
            $productGateway->addProduct(
                
            );

            die();
        }



        return Command::SUCCESS;
    }

    function openCsv(string $filepath): array
    {
        $output = [];
        if (($handle = fopen($filepath, "rb")) !== false) {
            fgetcsv($handle, 1000);
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $output[] = $data;
            }
            fclose($handle);
        }
        return $output;
    }

    protected function configure(): void
    {
        /** @var \Psr\Container\ContainerInterface $container */
        $this->container = require __DIR__ . '/../../../../config/container.php';


        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('add product with CSV file')
            // the command help shown when running the command with the "--help" option
            ->setHelp('this command allows you to add a product with CSV file')
            ->setName('addProduct:import')
            ->addArgument(
                'csv',
                InputArgument::REQUIRED,
                'give me beautiful CSV file in below format \n name,label,brand_id,description,price,width,height,category_id,package,material '
            );
    }

}