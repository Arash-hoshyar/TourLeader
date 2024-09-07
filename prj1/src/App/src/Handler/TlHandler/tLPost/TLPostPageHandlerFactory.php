<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tLPost;


use Admin\Handler\indexHandler\AdminHomePageHandler;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Handler\HomePageHandler;
use App\Handler\TlHandler\journey\TLJourneyPageHandler;
use App\Handler\TlHandler\main\TLHomePageHandler;
use App\Handler\TlHandler\tours\TLTourPageHandler;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\TL\JourneyService;
use App\Services\TL\PostService;
use App\Services\TL\TourService;
use App\Services\UserService\UserPurchaseInfoService;
use App\Services\WishListService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLPostPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {

        return new TLPostPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(PostService::class),
        );
    }

}
