<?php

declare(strict_types=1);

namespace Admin\Handler\extra;


use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminFormsPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminFormsPageHandler
    {

        return new AdminFormsPageHandler(
            $container->get(TemplateRendererInterface::class),
            );
    }
}
