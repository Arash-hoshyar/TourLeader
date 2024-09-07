<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tours;

use Admin\Handler\addProduct\AdminAddBrandPageHandler;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use App\DB\TlDB\TLJourneyGateWay;
use App\Handler\TlHandler\journey\TLAddJourneyPageHandler;
use App\Services\TL\JourneyService;
use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TourService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TLAddTourPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): TLAddTourPageHandler
    {
        return new TLAddTourPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TourService::class),
            $container->get(ImageService::class),
            $container->get(UrlHelper::class),
            $container->get(TLAuthorizationService::class),
        );
    }
}
