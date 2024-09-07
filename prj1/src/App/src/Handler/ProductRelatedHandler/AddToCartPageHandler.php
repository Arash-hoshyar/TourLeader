<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;

use Admin\Services\Product\ProductService;
use App\Services\CartService;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddToCartPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService  $adminProductService,
        private CartService                $cartService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $productId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($productId === 0) {

            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }
        $productOutput = $this->adminProductService->getALLProductById($productId);


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


        $data = [
            'product' => $productOutput,
            'cartProduct' => $addedProductOutput,
            'totalPrice' => $total,
        ];


        return new HtmlResponse($this->template->render('product::AddToCart',
            $data
        ));
    }
}
