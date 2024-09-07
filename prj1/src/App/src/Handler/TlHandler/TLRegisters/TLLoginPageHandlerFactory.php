<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\TLRegisters;

use App\Services\TL\TLAuthorizationService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TLLoginPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): TLLoginPageHandler
    {
        return new TLLoginPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TLAuthorizationService::class),
            $container->get(UrlHelper::class),

        );
    }
}
