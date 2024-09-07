#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use Admin\Command\AdminAddProductCommand;
use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->add(new AdminAddProductCommand());

$application->run();