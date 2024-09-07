<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminGetTopSellerPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminGetTopSellerPageHandler
    {
        return new AdminGetTopSellerPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TopSellerService::class),
        );
    }
}
