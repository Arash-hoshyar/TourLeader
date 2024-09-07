<?php

declare(strict_types=1);

namespace Admin\Handler\extra;


use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminTablesPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminTablesPageHandler
    {

        return new AdminTablesPageHandler(
            $container->get(TemplateRendererInterface::class),
            );
    }
}
