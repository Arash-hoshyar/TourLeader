<?php

declare(strict_types=1);

namespace App;

use App\DB\AdaptorFactory;
use App\DB\gateWay\cartRelatedGateWay\CartGateWay;
use App\DB\gateWay\cartRelatedGateWay\CartGateWayFactory;
use App\DB\gateWay\cartRelatedGateWay\CartPriceGateWay;
use App\DB\gateWay\cartRelatedGateWay\CartPriceGateWayFactory;
use App\DB\gateWay\userGateWay\userBillInfo\PresentAddressGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\PresentAddressGateWayFactory;
use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWayFactory;
use App\DB\gateWay\userGateWay\userBillInfo\UserProductCartGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserProductCartGateWayFactory;
use App\DB\gateWay\userGateWay\userBillInfo\UserPurchaseInfoGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserPurchaseInfoGateWayFactory;
use App\DB\gateWay\userGateWay\UserGateWay;
use App\DB\gateWay\userGateWay\UserGateWayFactory;
use App\DB\gateWay\WishListGateWay;
use App\DB\gateWay\WishListGateWayFactory;
use App\Handler\HomePageHandler;
use App\Handler\HomePageHandlerFactory;
use App\Handler\ProductRelatedHandler\AddToCartPageHandler;
use App\Handler\ProductRelatedHandler\AddToCartPageHandlerFactory;
use App\Handler\ProductRelatedHandler\CheckOutHandlerFactory;
use App\Handler\ProductRelatedHandler\CheckOutPageHandler;
use App\Handler\ProductRelatedHandler\ProductPageHandler;
use App\Handler\ProductRelatedHandler\ProductPageHandlerFactory;
use App\Handler\ProductRelatedHandler\StorePageHandler;
use App\Handler\ProductRelatedHandler\StorePageHandlerFactory;
use App\Handler\ProductRelatedHandler\WishListPageHandler;
use App\Handler\ProductRelatedHandler\WishListPageHandlerFactory;
use App\Handler\RegisterHandler\LoginPageHandler;
use App\Handler\RegisterHandler\LoginPageHandlerFactory;
use App\Handler\RegisterHandler\SignupPageHandler;
use App\Handler\RegisterHandler\SignupPageHandlerFactory;
use App\Handler\searchProduct\ShowSearchPageHandler;
use App\Handler\searchProduct\ShowSearchPageHandlerFactory;
use TourLeader\Middlewere\AuthenticationMiddleware;
use TourLeader\Middlewere\AuthenticationMiddlewareFactory;
use App\Services\CartPriceService;
use App\Services\CartPriceServiceFactory;
use App\Services\CartService;
use App\Services\CartServiceFactory;
use App\Services\UserService\AuthorizationService;
use App\Services\UserService\AuthorizationServiceFactory;
use App\Services\UserService\PresentAddressService;
use App\Services\UserService\PresentAddressServiceFactory;
use App\Services\UserService\UserAddressService;
use App\Services\UserService\UserAddressServiceFactory;
use App\Services\UserService\UserProductCartService;
use App\Services\UserService\UserProductCartServiceFactory;
use App\Services\UserService\UserPurchaseInfoService;
use App\Services\UserService\UserPurchaseInfoServiceFactory;
use App\Services\WishListService;
use App\Services\WishListServiceFactory;
use Laminas\Db\Adapter\AdapterInterface;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                App\Handler\PingHandler::class => App\Handler\PingHandler::class,
            ],
            'factories' => [
                //AdapterInterface
                AdapterInterface::class => AdaptorFactory::class,

                //PageHandler
                SignupPageHandler::class => SignupPageHandlerFactory::class,
                HomePageHandler::class => HomePageHandlerFactory::class,
                LoginPageHandler::class => LoginPageHandlerFactory::class,
                ProductPageHandler::class => ProductPageHandlerFactory::class,
                CheckOutPageHandler::class => CheckOutHandlerFactory::class,
                StorePageHandler::class => StorePageHandlerFactory::class,
                AddToCartPageHandler::class => AddToCartPageHandlerFactory::class,
                ShowSearchPageHandler::class => ShowSearchPageHandlerFactory::class,
                WishListPageHandler::class => WishListPageHandlerFactory::class,

                //Service
                AuthorizationService::class => AuthorizationServiceFactory::class,
                CartService::class => CartServiceFactory::class,
                UserAddressService::class => UserAddressServiceFactory::class,
                PresentAddressService::class => PresentAddressServiceFactory::class,
                WishListService::class => WishListServiceFactory::class,
                CartPriceService::class => CartPriceServiceFactory::class,
                UserProductCartService::class => UserProductCartServiceFactory::class,
                UserPurchaseInfoService::class => UserPurchaseInfoServiceFactory::class,

                //AuthenticationMiddleware
                AuthenticationMiddleware::class => AuthenticationMiddlewareFactory::class,

                //GateWay
                UserGateWay::class => UserGateWayFactory::class,
                CartGateWay::class => CartGateWayFactory::class,
                UserAddressGateWay::class => UserAddressGateWayFactory::class,
                PresentAddressGateWay::class => PresentAddressGateWayFactory::class,
                WishListGateWay::class => WishListGateWayFactory::class,
                CartPriceGateWay::class => CartPriceGateWayFactory::class,
                UserProductCartGateWay::class => UserProductCartGateWayFactory::class,
                UserPurchaseInfoGateWay::class => UserPurchaseInfoGateWayFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'extension' => 'twig',
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'register' => [__DIR__ . '/../templates/app/Register'],
                'product' => [__DIR__ . '/../templates/app/ProductRelated'],
                'search' => [__DIR__ . '/../templates/app/searchProduct'],
                'error' => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
