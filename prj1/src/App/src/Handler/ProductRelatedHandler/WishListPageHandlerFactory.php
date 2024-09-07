<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use App\Services\CartService;
use App\Services\WishListService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class WishListPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): WishListPageHandler
    {
        return new WishListPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(WishListService::class),
            $container->get(UrlHelper::class),
            $container->get(CartService::class),
        );
    }
}
