<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Services\Product\BrandService;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminAddProductPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminAddProductPageHandler
    {
        return new AdminAddProductPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(BrandService::class),
            $container->get(CategoryService::class),
            $container->get(MaterialService::class),
            $container->get(UrlHelper::class),
        );
    }
}
