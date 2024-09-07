<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;

use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Admin\Services\productRelated\TopSellerService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminGetProductPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminGetProductPageHandler
    {
        return new AdminGetProductPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(ProductMaterialCategoryService::class),
            $container->get(TopSellerService::class),
        );
    }
}
