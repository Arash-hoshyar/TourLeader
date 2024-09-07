<?php

declare(strict_types=1);

namespace TourLeader\Handler\TLRegisters;

use App\Handler\RegisterHandler\SignupPageHandler;
use App\Services\CartService;
use App\Services\UserService\AuthorizationService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use TourLeader\Service\TLAuthorizationService;

class TLSignupPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): TLSignupPageHandler
    {
        return new TLSignupPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TLAuthorizationService::class),
        );
    }
}
