<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\main;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\TL\PostService;
use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TourService;
use App\Services\UserService\AuthorizationService;
use App\Services\UserService\UserPurchaseInfoService;
use App\Services\WishListService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLHomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private UserPurchaseInfoService $userPurchaseInfoService,
        private TourService $tourService,
        private TLAuthorizationService $authorizationService,
        private PostService $postService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $product = $this->userPurchaseInfoService->getALLProduct();

        $guids = $this->authorizationService->allGuids();
        $tour = $this->tourService->getALLTour();
        $post = $this->postService->getALLPost();

        $data = [
            'product' => $product,
            'tours' => $tour,
            'guids' => $guids,
            'posts' => $post,
        ];


        return new HtmlResponse(
            $this->template->render(
                'tour::index',
                $data
            )
        );
    }
}
