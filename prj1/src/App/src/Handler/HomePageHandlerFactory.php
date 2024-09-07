<?php

declare(strict_types=1);

namespace App\Handler;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\WishListService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {

        return new HomePageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ProductService::class),
            $container->get(UrlHelper::class),
            $container->get(CartService::class),
            $container->get(CategoryService::class),
            $container->get(WishListService::class),
            $container->get(TopSellerService::class),
            $container->get(CartPriceService::class),
            );
    }
}
