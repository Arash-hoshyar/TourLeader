<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;


use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminGetMaterialPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminGetMaterialPageHandler
    {
        return new AdminGetMaterialPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(MaterialService::class),
            $container->get(ProductMaterialCategoryService::class),
        );
    }
}
