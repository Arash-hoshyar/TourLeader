<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use Admin\Services\Product\ProductService;
use App\Services\CartService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;


class AddToCartPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AddToCartPageHandler
    {
        return new AddToCartPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(CartService::class),
        );
    }
}
