<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\journey;

use Admin\Handler\addProduct\AdminAddBrandPageHandler;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use App\DB\TlDB\TLJourneyGateWay;
use App\Services\TL\JourneyService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TLAddJourneyPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): TLAddJourneyPageHandler
    {
        return new TLAddJourneyPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(JourneyService::class),
            $container->get(ImageService::class),
            $container->get(UrlHelper::class),
        );
    }
}
