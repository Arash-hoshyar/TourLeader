<?php

declare(strict_types=1);

namespace Admin\Handler\indexHandler;


use App\Services\UserService\UserPurchaseInfoService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminHomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {

        return new AdminHomePageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(UserPurchaseInfoService::class),
            );
    }
}
