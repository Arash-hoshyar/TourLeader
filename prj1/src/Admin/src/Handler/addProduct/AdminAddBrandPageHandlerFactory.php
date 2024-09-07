<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminAddBrandPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminAddBrandPageHandler
    {
        return new AdminAddBrandPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(BrandService::class),
            $container->get(ImageService::class),
            $container->get(UrlHelper::class),
        );
    }
}
