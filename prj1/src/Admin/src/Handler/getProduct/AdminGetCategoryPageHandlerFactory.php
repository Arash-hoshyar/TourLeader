<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminGetCategoryPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminGetCategoryPageHandler
    {
        return new AdminGetCategoryPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(CategoryService::class),
            $container->get(ProductService::class),
        );
    }
}
