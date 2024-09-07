<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use Admin\Services\Product\ProductService;
use App\Services\CartService;
use App\Services\WishListService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProductPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService        $adminProductService,
        private CartService                $cartService,
        private UrlHelper                  $urlHelper,
        private WishListService       $wishListService,
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {

            $postedData = $request->getParsedBody();
            $session = $_COOKIE['PHPSESSID'];

            if (isset($_SESSION['user_email'])) {
                $session = $_SESSION['user_email'];
            }

            if (isset($postedData['wishListValue'])) {
                $this->wishListService->addWishlist((int)$postedData['wishListValue'], $session);


                return new JsonResponse(['url' => $this->urlHelper->generate('wish.and.get')]);
            }

            $this->cartService->addCart((int)$postedData['value'], $session);


            return new JsonResponse(['url' => $this->urlHelper->generate('AddToCart')]);
        }

//show product
        $productId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($productId === 0) {

            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }
        $productOutput = $this->adminProductService->getALLProductById($productId);
        $productsOutput = $this->adminProductService->getALLProduct();


        $session = $_COOKIE['PHPSESSID'];

        if (isset($_SESSION['user_email'])) {
            $session = $_SESSION['user_email'];
        }

        $productIds = $this->cartService->selectCart($session);
        $productIdsCollection = [];

        foreach ($productIds as $item) {
            $productIdsCollection [] = (int)$item['product_id'];
        }
        $finalProductIdsCollection = (implode(',', $productIdsCollection));
        $addedProductOutput = $this->cartService->getALLCartByproductIds($finalProductIdsCollection);

        $total = 0;
        foreach ($addedProductOutput as $item) {
            $total += (int)$item['price'];
        }

//end show product


        $data = [
            'product' => $productOutput,
            'products' => $productsOutput,
            'cartProduct' => $addedProductOutput,
            'totalPrice' => $total,
        ];


        return new HtmlResponse($this->template->render('product::product',
            $data
        ));
    }
}
