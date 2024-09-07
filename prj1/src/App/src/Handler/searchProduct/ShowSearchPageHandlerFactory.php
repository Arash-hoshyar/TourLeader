<?php

declare(strict_types=1);

namespace App\Handler\searchProduct;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use App\Services\CartService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ShowSearchPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): ShowSearchPageHandler
    {
        return new ShowSearchPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(CartService::class),
            $container->get(CategoryService::class),
            $container->get(MaterialService::class),
            $container->get(ProductMaterialCategoryService::class),
            $container->get(UrlHelper::class),
        );
    }
}
