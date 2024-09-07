<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tLPost;

use Admin\Handler\addProduct\AdminAddBrandPageHandler;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use App\DB\TlDB\TLJourneyGateWay;
use App\Handler\TlHandler\journey\TLAddJourneyPageHandler;
use App\Services\TL\JourneyService;
use App\Services\TL\PostService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TLAddPostPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): TLAddPostPageHandler
    {
        return new TLAddPostPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(PostService::class),
            $container->get(ImageService::class),
            $container->get(UrlHelper::class),
        );
    }
}
