<?php

namespace Api\Handler;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProductBySearchApiHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProductBySearchApiHandler
    {
        return new ProductBySearchApiHandler(
            $container->get(ProductService::class),
            $container->get(CategoryService::class),
            $container->get(TemplateRendererInterface::class),
        );
    }
}