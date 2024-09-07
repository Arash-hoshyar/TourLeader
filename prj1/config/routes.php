<?php

declare(strict_types=1);

use Admin\Handler\addProduct\AdminAddBrandPageHandler;
use Admin\Handler\addProduct\AdminAddCategoryPageHandler;
use Admin\Handler\addProduct\AdminAddMaterialPageHandler;
use Admin\Handler\addProduct\AdminAddProductPageHandler;
use Admin\Handler\editProduct\AdminEditBrandPageHandler;
use Admin\Handler\editProduct\AdminEditCategoryPageHandler;
use Admin\Handler\editProduct\AdminEditMaterialPageHandler;
use Admin\Handler\editProduct\AdminEditProductPageHandler;
use Admin\Handler\extra\AdminCalendarPageHandler;
use Admin\Handler\extra\AdminFormsPageHandler;
use Admin\Handler\extra\AdminIconsPageHandler;
use Admin\Handler\extra\AdminProfilePageHandler;
use Admin\Handler\extra\AdminTablesPageHandler;
use Admin\Handler\getProduct\AdminGetBrandPageHandler;
use Admin\Handler\getProduct\AdminGetCategoryPageHandler;
use Admin\Handler\getProduct\AdminGetMaterialPageHandler;
use Admin\Handler\getProduct\AdminGetProductPageHandler;
use Admin\Handler\getProduct\AdminGetTopSellerPageHandler;
use Admin\Handler\indexHandler\AdminHomePageHandler;
use Admin\Handler\registerHandler\AdminChangePasswordPageHandler;
use Admin\Handler\registerHandler\AdminLoginPageHandler;
use Admin\Handler\registerHandler\AdminSignupPageHandler;
use Admin\Middlewere\AdminAuthenticationMiddleware;
use Api\Handler\ProductApiHandler;
use Api\Handler\ProductBySearchApiHandler;
use App\Handler\HomePageHandler;
use App\Handler\ProductRelatedHandler\AddToCartPageHandler;
use App\Handler\ProductRelatedHandler\CheckOutPageHandler;
use App\Handler\ProductRelatedHandler\ProductPageHandler;
use App\Handler\ProductRelatedHandler\StorePageHandler;
use App\Handler\ProductRelatedHandler\WishListPageHandler;
use App\Handler\RegisterHandler\LoginPageHandler;
use App\Handler\RegisterHandler\SignupPageHandler;
use App\Handler\searchProduct\ShowSearchPageHandler;
use App\Handler\TlHandler\journey\EditJourneyPageHandler;
use App\Handler\TlHandler\journey\TLAddJourneyPageHandler;
use App\Handler\TlHandler\journey\TLJourneyPageHandler;
use App\Handler\TlHandler\main\TLGuidHomePageHandler;
use App\Handler\TlHandler\main\TLHomePageHandler;
use App\Handler\TlHandler\tLPost\EditPostPageHandler;
use App\Handler\TlHandler\tLPost\TLAddPostPageHandler;
use App\Handler\TlHandler\tLPost\TLPostPageHandler;
use App\Handler\TlHandler\tLPost\TLViewPostPageHandler;
use App\Handler\TlHandler\TLRegisters\TLFullSignupPageHandler;
use App\Handler\TlHandler\TLRegisters\TLLoginPageHandler;
use App\Handler\TlHandler\TLRegisters\TLSignupPageHandler;
use App\Handler\TlHandler\tours\EditTourPageHandler;
use App\Handler\TlHandler\tours\TLAddTourPageHandler;
use App\Handler\TlHandler\tours\TLTourPageHandler;
use App\Handler\TlHandler\tours\TLViewTourPageHandler;
use App\Middlewere\AuthenticationMiddleware;
use App\Middlewere\TLAuthenticationMiddleware;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\AdminHomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    //user route
    $app->route('/', [HomePageHandler::class], ['GET', 'POST'], 'home');
    $app->route('/store', [StorePageHandler::class], ['GET', 'POST'], 'store');
    $app->route(
        '/lastcheck',
        [AuthenticationMiddleware::class, CheckOutPageHandler::class],
        ['GET', 'POST'],
        'checkout'
    );
    $app->route('/login', LoginPageHandler::class, ['GET', 'POST'], 'login');
    $app->route('/signup', SignupPageHandler::class, ['GET', 'POST'], 'signup');
    $app->route('/product/', [ProductPageHandler::class], ['GET', 'POST'], 'product');
    $app->route('/addtocart/', [AddToCartPageHandler::class], ['GET', 'POST'], 'AddToCart');
    $app->route('/search/result', [ShowSearchPageHandler::class], ['GET', 'POST'], 'search.result');
    $app->route('/wish/and/get', [WishListPageHandler::class], ['GET', 'POST'], 'wish.and.get');

    // Api route
    $app->route('/api/product/', [ProductApiHandler::class], ['GET', 'POST'], 'api.product');
    $app->route('/api/product/search/', [ProductBySearchApiHandler::class], ['GET', 'POST'], 'api.search');


    //admin route


    // main
    $app->route(
        '/admin',
        [AdminAuthenticationMiddleware::class, AdminHomePageHandler::class],
        ['GET', 'POST'],
        'admin'
    );


    // login
    $app->route('/adminlogin', AdminLoginPageHandler::class, ['GET', 'POST'], 'adminlogin');
    $app->route(
        '/adminsignup',
        [AdminAuthenticationMiddleware::class, AdminSignupPageHandler::class],
        ['GET', 'POST'],
        'adminsignup'
    );
    $app->route(
        '/adminchangepassword',
        [AdminAuthenticationMiddleware::class, AdminChangePasswordPageHandler::class],
        ['GET', 'POST'],
        'adminchangepassword'
    );


    //extra
    $app->route(
        '/admincalender',
        [AdminAuthenticationMiddleware::class, AdminCalendarPageHandler::class],
        ['GET', 'POST'],
        'admincelendar'
    );
    $app->route(
        '/adminform',
        [AdminAuthenticationMiddleware::class, AdminFormsPageHandler::class],
        ['GET', 'POST'],
        'adminform'
    );
    $app->route(
        '/adminicons',
        [AdminAuthenticationMiddleware::class, AdminIconsPageHandler::class],
        ['GET', 'POST'],
        'adminicons'
    );
    $app->route(
        '/adminprofile',
        [AdminAuthenticationMiddleware::class, AdminProfilePageHandler::class],
        ['GET', 'POST'],
        'adminprofile'
    );
    $app->route(
        '/admintable',
        [AdminAuthenticationMiddleware::class, AdminTablesPageHandler::class],
        ['GET', 'POST'],
        'admintable'
    );


    //product add
    $app->route(
        '/admin/add/brand',
        [AdminAuthenticationMiddleware::class, AdminAddBrandPageHandler::class],
        ['GET', 'POST'],
        'admin.add.brand'
    );

    $app->route(
        '/admin/add/protuct',
        [AdminAuthenticationMiddleware::class, AdminAddProductPageHandler::class],
        ['GET', 'POST'],
        'admin.add.product'
    );

    $app->route(
        '/admin/add/category',
        [AdminAuthenticationMiddleware::class, AdminAddCategoryPageHandler::class],
        ['GET', 'POST'],
        'admin.add.category'
    );
    $app->route(
        '/admin/add/material',
        [AdminAuthenticationMiddleware::class, AdminAddMaterialPageHandler::class],
        ['GET', 'POST'],
        'admin.add.material'
    );


    //product get
    $app->route(
        '/admin/get/product/',
        [AdminAuthenticationMiddleware::class, AdminGetProductPageHandler::class],
        ['GET', 'POST'],
        'admin.get.product'
    );
    $app->route(
        '/admin/get/brand/',
        [AdminAuthenticationMiddleware::class, AdminGetBrandPageHandler::class],
        ['GET', 'POST'],
        'admin.get.brand'
    );
    $app->route(
        '/admin/get/category/',
        [AdminAuthenticationMiddleware::class, AdminGetCategoryPageHandler::class],
        ['GET', 'POST'],
        'admin.get.category'
    );
    $app->route(
        '/admin/get/material/',
        [AdminAuthenticationMiddleware::class, AdminGetMaterialPageHandler::class],
        ['GET', 'POST'],
        'admin.get.material'
    );
    $app->route(
        '/admin/get/top/seller/',
        [AdminAuthenticationMiddleware::class, AdminGetTopSellerPageHandler::class],
        ['GET', 'POST'],
        'admin.get.top.seller'
    );


    //product edit
    $app->route(
        '/admineditcategory/',
        [AdminAuthenticationMiddleware::class, AdminEditCategoryPageHandler::class],
        ['GET', 'POST'],
        'admineditcategory'
    );
    $app->route(
        '/admineditproduct/',
        [AdminAuthenticationMiddleware::class, AdminEditProductPageHandler::class],
        ['GET', 'POST'],
        'admineditproduct'
    );
    $app->route(
        '/admineditbrand/',
        [AdminAuthenticationMiddleware::class, AdminEditBrandPageHandler::class],
        ['GET', 'POST'],
        'admineditbrand'
    );
    $app->route(
        '/admineditmaterial/',
        [AdminAuthenticationMiddleware::class, AdminEditMaterialPageHandler::class],
        ['GET', 'POST'],
        'admineditmaterial'
    );


    // TL route
    //login
    $app->route('/tllogin', TLLoginPageHandler::class, ['GET', 'POST'], 'tllogin');
    $app->route('/tlsignup', TLSignupPageHandler::class, ['GET', 'POST'], 'tlsignup');
    $app->route('/tlfullsignup/', TLFullSignupPageHandler::class, ['GET', 'POST'], 'tlfullsignup');

    //main

    $app->route('/home', [TLHomePageHandler::class], ['GET', 'POST'], 'index');

    $app->route(
        '/guid',
        [TLAuthenticationMiddleware::class, TLGuidHomePageHandler::class],
        ['GET', 'POST'],
        'guid'
    );
    $app->route(
        '/tljourney',
        [TLAuthenticationMiddleware::class, TLJourneyPageHandler::class],
        ['GET', 'POST'],
        'tljourney'
    );
    $app->route(
        '/addtljourney',
        [TLAuthenticationMiddleware::class, TLAddJourneyPageHandler::class],
        ['GET', 'POST'],
        'addtljourney'
    );
    $app->route(
        '/edittljourney/',
        [TLAuthenticationMiddleware::class, EditJourneyPageHandler::class],
        ['GET', 'POST'],
        'edittljourney'
    );

    $app->route(
        '/tltour',
        [TLAuthenticationMiddleware::class, TLTourPageHandler::class],
        ['GET', 'POST'],
        'tltour'
    );
    $app->route(
        '/edittltour/',
        [TLAuthenticationMiddleware::class, EditTourPageHandler::class],
        ['GET', 'POST'],
        'edittltour'
    );
    $app->route(
        '/addtltour',
        [TLAuthenticationMiddleware::class, TLAddTourPageHandler::class],
        ['GET', 'POST'],
        'addtltour'
    );
    $app->route(
        '/viewtltour/',
        [TLAuthenticationMiddleware::class, TLViewTourPageHandler::class],
        ['GET', 'POST'],
        'viewtltour'
    );

    $app->route(
        '/post',
        [TLAuthenticationMiddleware::class, TLPostPageHandler::class],
        ['GET', 'POST'],
        'post'
    );
    $app->route(
        '/addpost',
        [TLAuthenticationMiddleware::class, TLAddPostPageHandler::class],
        ['GET', 'POST'],
        'addpost'
    );
    $app->route(
        '/editpost/',
        [TLAuthenticationMiddleware::class, EditPostPageHandler::class],
        ['GET', 'POST'],
        'editpost'
    );

$app->route(
        '/viewtlpost/',
        [TLAuthenticationMiddleware::class, TLViewPostPageHandler::class],
        ['GET', 'POST'],
        'viewtlpost'
    );

};
//$app->get('/api/ping', PingHandler::class, 'api.ping');

