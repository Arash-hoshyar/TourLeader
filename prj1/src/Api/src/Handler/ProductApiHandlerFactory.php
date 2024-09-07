<?php

namespace Api\Handler;


use Admin\Services\Product\ProductService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProductApiHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProductApiHandler
    {
        return new ProductApiHandler(
            $container->get(ProductService::class),
            $container->get(TemplateRendererInterface::class),
        );
    }
}