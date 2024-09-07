<?php

declare(strict_types=1);

namespace Admin\Handler\extra;


use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminCalendarPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminCalendarPageHandler
    {

        return new AdminCalendarPageHandler(
            $container->get(TemplateRendererInterface::class),
            );
    }
}
