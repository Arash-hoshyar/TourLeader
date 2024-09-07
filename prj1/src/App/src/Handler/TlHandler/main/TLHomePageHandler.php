<?php

declare(strict_types=1);

namespace TourLeader\Handler\main;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
use App\Services\CartService;
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
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $product = $this->userPurchaseInfoService->getALLProduct();

        $data = [
            'product' => $product,
        ];

        return new HtmlResponse(
            $this->template->render(
                'index::index',
                $data
            )
        );
    }
}
