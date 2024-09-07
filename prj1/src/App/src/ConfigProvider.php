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
use App\DB\TlDB\MassageGateWay;
use App\DB\TlDB\MassageGateWayFactory;
use App\DB\TlDB\TLJourneyGateWay;
use App\DB\TlDB\TLJourneyGateWayFactory;
use App\DB\TlDB\TLPostGateWay;
use App\DB\TlDB\TLPostGateWayFactory;
use App\DB\TlDB\TLToursGateWay;
use App\DB\TlDB\TLToursGateWayFactory;
use App\DB\TlDB\TourLeaderGateWay;
use App\DB\TlDB\TourLeaderGateWayFactory;
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
use App\Handler\TlHandler\journey\EditJourneyPageHandler;
use App\Handler\TlHandler\journey\EditJourneyPageHandlerFactory;
use App\Handler\TlHandler\journey\TLAddJourneyPageHandler;
use App\Handler\TlHandler\journey\TLAddJourneyPageHandlerFactory;
use App\Handler\TlHandler\journey\TLJourneyPageHandler;
use App\Handler\TlHandler\journey\TLJourneyPageHandlerFactory;
use App\Handler\TlHandler\main\TLGuidHomePageHandler;
use App\Handler\TlHandler\main\TLGuidHomePageHandlerFactory;
use App\Handler\TlHandler\main\TLHomePageHandler;
use App\Handler\TlHandler\main\TLHomePageHandlerFactory;
use App\Handler\TlHandler\tLPost\EditPostPageHandler;
use App\Handler\TlHandler\tLPost\EditPostPageHandlerFactory;
use App\Handler\TlHandler\tLPost\TLAddPostPageHandler;
use App\Handler\TlHandler\tLPost\TLAddPostPageHandlerFactory;
use App\Handler\TlHandler\tLPost\TLPostPageHandler;
use App\Handler\TlHandler\tLPost\TLPostPageHandlerFactory;
use App\Handler\TlHandler\tLPost\TLViewPostPageHandler;
use App\Handler\TlHandler\tLPost\TLViewPostPageHandlerFactory;
use App\Handler\TlHandler\TLRegisters\TLFullSignupPageHandler;
use App\Handler\TlHandler\TLRegisters\TLFullSignupPageHandlerFactory;
use App\Handler\TlHandler\TLRegisters\TLLoginPageHandler;
use App\Handler\TlHandler\TLRegisters\TLLoginPageHandlerFactory;
use App\Handler\TlHandler\TLRegisters\TLSignupPageHandler;
use App\Handler\TlHandler\TLRegisters\TLSignupPageHandlerFactory;
use App\Handler\TlHandler\tours\EditTourPageHandler;
use App\Handler\TlHandler\tours\EditTourPageHandlerFactory;
use App\Handler\TlHandler\tours\TLAddTourPageHandler;
use App\Handler\TlHandler\tours\TLAddTourPageHandlerFactory;
use App\Handler\TlHandler\tours\TLTourPageHandler;
use App\Handler\TlHandler\tours\TLTourPageHandlerFactory;
use App\Handler\TlHandler\tours\TLViewTourPageHandler;
use App\Handler\TlHandler\tours\TLViewTourPageHandlerFactory;
use App\Middlewere\AuthenticationMiddleware;
use App\Middlewere\AuthenticationMiddlewareFactory;
use App\Middlewere\TLAuthenticationMiddleware;
use App\Middlewere\TLAuthenticationMiddlewareFactory;
use App\Services\CartPriceService;
use App\Services\CartPriceServiceFactory;
use App\Services\CartService;
use App\Services\CartServiceFactory;
use App\Services\TL\invokebles\TLImageService;
use App\Services\TL\JourneyService;
use App\Services\TL\JourneyServiceFactory;
use App\Services\TL\MassageService;
use App\Services\TL\MassageServiceFactory;
use App\Services\TL\PostService;
use App\Services\TL\PostServiceFactory;
use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TLAuthorizationServiceFactory;
use App\Services\TL\TourService;
use App\Services\TL\TourServiceFactory;
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
                TLImageService::class => TLImageService::class,
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


                TLJourneyPageHandler::class => TLJourneyPageHandlerFactory::class,
                TLHomePageHandler::class => TLHomePageHandlerFactory::class,
                TLLoginPageHandler::class => TLLoginPageHandlerFactory::class,
                TLSignupPageHandler::class => TLSignupPageHandlerFactory::class,
                TLFullSignupPageHandler::class => TLFullSignupPageHandlerFactory::class,
                TLGuidHomePageHandler::class => TLGuidHomePageHandlerFactory::class,
                TLAddJourneyPageHandler::class => TLAddJourneyPageHandlerFactory::class,
                EditJourneyPageHandler::class => EditJourneyPageHandlerFactory::class,
                TLViewTourPageHandler::class => TLViewTourPageHandlerFactory::class,

                TLTourPageHandler::class => TLTourPageHandlerFactory::class,
                TLAddTourPageHandler::class => TLAddTourPageHandlerFactory::class,
                EditTourPageHandler::class => EditTourPageHandlerFactory::class,

                TLPostPageHandler::class => TLPostPageHandlerFactory::class,
                TLaddPostPageHandler::class => TLaddPostPageHandlerFactory::class,
                EditPostPageHandler::class => EditPostPageHandlerFactory::class,
                TLViewPostPageHandler::class => TLViewPostPageHandlerFactory::class,

                //Service
                AuthorizationService::class => AuthorizationServiceFactory::class,
                CartService::class => CartServiceFactory::class,
                UserAddressService::class => UserAddressServiceFactory::class,
                PresentAddressService::class => PresentAddressServiceFactory::class,
                WishListService::class => WishListServiceFactory::class,
                CartPriceService::class => CartPriceServiceFactory::class,
                UserProductCartService::class => UserProductCartServiceFactory::class,
                UserPurchaseInfoService::class => UserPurchaseInfoServiceFactory::class,

                TLAuthorizationService::class => TLAuthorizationServiceFactory::class,
                JourneyService::class => JourneyServiceFactory::class,
                TourService::class => TourServiceFactory::class,
                PostService::class => PostServiceFactory::class,
                MassageService::class => MassageServiceFactory::class,

                //AuthenticationMiddleware
                AuthenticationMiddleware::class => AuthenticationMiddlewareFactory::class,

                TLAuthenticationMiddleware::class => TLAuthenticationMiddlewareFactory::class,

                //GateWay
                UserGateWay::class => UserGateWayFactory::class,
                CartGateWay::class => CartGateWayFactory::class,
                UserAddressGateWay::class => UserAddressGateWayFactory::class,
                PresentAddressGateWay::class => PresentAddressGateWayFactory::class,
                WishListGateWay::class => WishListGateWayFactory::class,
                CartPriceGateWay::class => CartPriceGateWayFactory::class,
                UserProductCartGateWay::class => UserProductCartGateWayFactory::class,
                UserPurchaseInfoGateWay::class => UserPurchaseInfoGateWayFactory::class,

                TourLeaderGateWay::class => TourLeaderGateWayFactory::class,
                TLJourneyGateWay::class => TLJourneyGateWayFactory::class,
                TLToursGateWay::class => TLToursGateWayFactory::class,
                TLPostGateWay::class => TLPostGateWayFactory::class,
                MassageGateWay::class => MassageGateWayFactory::class,
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
                'tourRegister' => [__DIR__ . '/../templates/app/tl/tlRegister'],
                'post' => [__DIR__ . '/../templates/app/tl/addEditSeePost'],
                'addTour' => [__DIR__ . '/../templates/app/tl/addSeeEditTours'],
                'addJourney' => [__DIR__ . '/../templates/app/tl/addEditJourney'],
                'tourGuid' => [__DIR__ . '/../templates/app/tl/guidPage'],
                'tour' => [__DIR__ . '/../templates/app/tl'],
                'register' => [__DIR__ . '/../templates/app/Register'],
                'product' => [__DIR__ . '/../templates/app/ProductRelated'],
                'search' => [__DIR__ . '/../templates/app/searchProduct'],
                'error' => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
