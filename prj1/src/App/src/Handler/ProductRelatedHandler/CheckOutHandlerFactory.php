<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use Admin\Services\Product\ProductService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\UserService\PresentAddressService;
use App\Services\UserService\UserAddressService;
use App\Services\UserService\UserProductCartService;
use App\Services\UserService\UserPurchaseInfoService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;


class CheckOutHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new CheckOutPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(CartService::class),
            $container->get(UserAddressService::class),
            $container->get(PresentAddressService::class),
            $container->get(UrlHelper::class),
            $container->get(CartPriceService::class),
            $container->get(UserProductCartService::class),
            $container->get(ProductService::class),
            $container->get(UserPurchaseInfoService::class),
        );
    }
}
