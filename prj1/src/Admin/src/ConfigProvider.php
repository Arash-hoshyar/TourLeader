<?php

declare(strict_types=1);

namespace Admin;

use Admin\DB\AdminGateWay;
use Admin\DB\AdminGateWayFactory;
use Admin\DB\product\BrandGateWay;
use Admin\DB\product\BrandGateWayFactory;
use Admin\DB\product\CategoryGateWay;
use Admin\DB\product\CategoryGateWayFactory;
use Admin\DB\product\MaterialGateWay;
use Admin\DB\product\MaterialGateWayFactory;
use Admin\DB\product\ProductGateWay;
use Admin\DB\product\ProductGateWayFactory;
use Admin\DB\productRelated\AdminProductMaterialCategoryGateWay;
use Admin\DB\productRelated\AdminProductMaterialCategoryGateWayFactory;
use Admin\DB\productRelated\TopSellerGateWay;
use Admin\DB\productRelated\TopSellerGateWayFactory;
use Admin\Handler\addProduct\AdminAddBrandPageHandler;
use Admin\Handler\addProduct\AdminAddBrandPageHandlerFactory;
use Admin\Handler\addProduct\AdminAddCategoryPageHandler;
use Admin\Handler\addProduct\AdminAddCategoryPageHandlerFactory;
use Admin\Handler\addProduct\AdminAddMaterialPageHandler;
use Admin\Handler\addProduct\AdminAddMaterialPageHandlerFactory;
use Admin\Handler\addProduct\AdminAddProductPageHandler;
use Admin\Handler\addProduct\AdminAddProductPageHandlerFactory;
use Admin\Handler\editProduct\AdminEditBrandPageHandler;
use Admin\Handler\editProduct\AdminEditBrandPageHandlerFactory;
use Admin\Handler\editProduct\AdminEditCategoryPageHandler;
use Admin\Handler\editProduct\AdminEditCategoryPageHandlerFactory;
use Admin\Handler\editProduct\AdminEditMaterialPageHandler;
use Admin\Handler\editProduct\AdminEditMaterialPageHandlerFactory;
use Admin\Handler\editProduct\AdminEditProductPageHandler;
use Admin\Handler\editProduct\AdminEditProductPageHandlerFactory;
use Admin\Handler\extra\AdminCalendarPageHandler;
use Admin\Handler\extra\AdminCalendarPageHandlerFactory;
use Admin\Handler\extra\AdminFormsPageHandler;
use Admin\Handler\extra\AdminFormsPageHandlerFactory;
use Admin\Handler\extra\AdminIconsPageHandler;
use Admin\Handler\extra\AdminIconsPageHandlerFactory;
use Admin\Handler\extra\AdminProfilePageHandler;
use Admin\Handler\extra\AdminProfilePageHandlerFactory;
use Admin\Handler\extra\AdminTablesPageHandler;
use Admin\Handler\extra\AdminTablesPageHandlerFactory;
use Admin\Handler\getProduct\AdminGetBrandPageHandler;
use Admin\Handler\getProduct\AdminGetBrandPageHandlerFactory;
use Admin\Handler\getProduct\AdminGetCategoryPageHandler;
use Admin\Handler\getProduct\AdminGetCategoryPageHandlerFactory;
use Admin\Handler\getProduct\AdminGetMaterialPageHandler;
use Admin\Handler\getProduct\AdminGetMaterialPageHandlerFactory;
use Admin\Handler\getProduct\AdminGetProductPageHandler;
use Admin\Handler\getProduct\AdminGetProductPageHandlerFactory;
use Admin\Handler\getProduct\AdminGetTopSellerPageHandler;
use Admin\Handler\getProduct\AdminGetTopSellerPageHandlerFactory;
use Admin\Handler\indexHandler\AdminHomePageHandler;
use Admin\Handler\indexHandler\AdminHomePageHandlerFactory;
use Admin\Handler\registerHandler\AdminChangePasswordPageHandler;
use Admin\Handler\registerHandler\AdminChangePasswordPageHandlerFactory;
use Admin\Handler\registerHandler\AdminLoginPageHandler;
use Admin\Handler\registerHandler\AdminLoginPageHandlerFactory;
use Admin\Handler\registerHandler\AdminSignupPageHandler;
use Admin\Handler\registerHandler\AdminSignupPageHandlerFactory;
use Admin\Middlewere\AdminAuthenticationMiddleware;
use Admin\Middlewere\AdminAuthenticationMiddlewareFactory;
use Admin\Services\AdminAuthorizationService;
use Admin\Services\AdminAuthorizationServiceFactory;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use Admin\Services\Product\BrandServiceFactory;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\CategoryServiceFactory;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\MaterialServiceFactory;
use Admin\Services\Product\ProductService;
use Admin\Services\Product\ProductServiceFactory;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Admin\Services\productRelated\ProductMaterialCategoryServiceFactory;
use Admin\Services\productRelated\TopSellerService;
use Admin\Services\productRelated\TopSellerServiceFactory;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;

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

            ],
            'factories' => [


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
            ],
        ];
    }
}
