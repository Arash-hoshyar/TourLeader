<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use App\Services\CartService;
use App\Services\WishListService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class StorePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): StorePageHandler
    {
        return new StorePageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(CartService::class),
            $container->get(UrlHelper::class),
            $container->get(WishListService::class),
        );
    }
}
