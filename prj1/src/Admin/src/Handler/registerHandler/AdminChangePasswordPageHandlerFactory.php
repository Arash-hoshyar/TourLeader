<?php

declare(strict_types=1);

namespace Admin\Handler\registerHandler;

use Admin\Services\AdminAuthorizationService;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminChangePasswordPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminChangePasswordPageHandler
    {
        return new AdminChangePasswordPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(AdminAuthorizationService::class),
            $container->get(Message::class),
            $container->get(Sendmail::class)
        );
    }
}
