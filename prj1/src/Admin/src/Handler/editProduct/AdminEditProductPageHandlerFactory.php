<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;

use Admin\Services\Product\BrandService;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminEditProductPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminEditProductPageHandler
    {
        return new AdminEditProductPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(BrandService::class),
            $container->get(CategoryService::class),
            $container->get(MaterialService::class),
            $container->get(ProductMaterialCategoryService::class),
            $container->get(UrlHelper::class),
        );
    }
}
