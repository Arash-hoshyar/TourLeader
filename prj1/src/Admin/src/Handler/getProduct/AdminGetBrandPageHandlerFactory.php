<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;


use Admin\Services\Product\BrandService;
use Admin\Services\Product\ProductService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminGetBrandPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminGetBrandPageHandler
    {
        return new AdminGetBrandPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(BrandService::class),
            $container->get(ProductService::class),
        );
    }
}
