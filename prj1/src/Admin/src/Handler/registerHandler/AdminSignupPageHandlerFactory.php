<?php

declare(strict_types=1);

namespace Admin\Handler\registerHandler;

use Admin\Services\AdminAuthorizationService;

use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminSignupPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminSignupPageHandler
    {
        return new AdminSignupPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(AdminAuthorizationService::class),
            $container->get(UrlHelper::class)
        );
    }
}
