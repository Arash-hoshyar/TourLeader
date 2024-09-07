<?php

declare(strict_types=1);

namespace TourLeader\Handler\TLRegisters;

use App\Handler\RegisterHandler\LoginPageHandler;
use App\Services\CartService;
use App\Services\UserService\AuthorizationService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use TourLeader\Service\TLAuthorizationService;

class TLLoginPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): TLLoginPageHandler
    {
        return new TLLoginPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TLAuthorizationService::class),
        );
    }
}
