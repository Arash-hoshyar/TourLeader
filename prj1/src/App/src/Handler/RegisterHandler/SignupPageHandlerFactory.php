<?php

declare(strict_types=1);

namespace App\Handler\RegisterHandler;

use App\Services\CartService;
use App\Services\UserService\AuthorizationService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class SignupPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): SignupPageHandler
    {
        return new SignupPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(AuthorizationService::class),
            $container->get(CartService::class),
        );
    }
}
