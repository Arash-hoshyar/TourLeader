<?php

declare(strict_types=1);

namespace Admin\Handler\extra;


use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminIconsPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminIconsPageHandler
    {

        return new AdminIconsPageHandler(
            $container->get(TemplateRendererInterface::class),
            );
    }
}
