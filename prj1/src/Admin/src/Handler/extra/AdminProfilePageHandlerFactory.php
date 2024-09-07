<?php

declare(strict_types=1);

namespace Admin\Handler\extra;


use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminProfilePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminProfilePageHandler
    {

        return new AdminProfilePageHandler(
            $container->get(TemplateRendererInterface::class),
            );
    }
}
