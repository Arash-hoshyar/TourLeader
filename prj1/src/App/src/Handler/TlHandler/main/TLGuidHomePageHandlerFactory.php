<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\main;


use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TourService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLGuidHomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {

        return new TLGuidHomePageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TLAuthorizationService::class),
            $container->get(TourService::class),
        );
    }

}
