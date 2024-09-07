<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\main;


use Admin\Handler\indexHandler\AdminHomePageHandler;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Handler\HomePageHandler;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\TL\PostService;
use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TourService;
use App\Services\UserService\AuthorizationService;
use App\Services\UserService\UserPurchaseInfoService;
use App\Services\WishListService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLHomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {

        return new TLHomePageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(UserPurchaseInfoService::class),
            $container->get(TourService::class),
            $container->get(TLAuthorizationService::class),
            $container->get(PostService::class),
        );
    }

}
