<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use Admin\Services\Product\ProductService;
use App\Services\CartService;
use App\Services\WishListService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;


class ProductPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProductPageHandler
    {
        return new ProductPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(CartService::class),
            $container->get(UrlHelper::class),
            $container->get(WishListService::class),
        );
    }
}
