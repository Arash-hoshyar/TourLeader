<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;


use App\Services\CartService;
use App\Services\WishListService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class StorePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private CartService $cartService,
        private UrlHelper $urlHelper,
        private WishListService $wishListService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = $_COOKIE['PHPSESSID'];

        if (isset($_SESSION['user_email'])) {
            $session = $_SESSION['user_email'];
        }

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();

            if (isset($postedData['wishListValue'])) {
                $this->wishListService->addWishlist((int)$postedData['wishListValue'], $session);


                return new JsonResponse(['url' => $this->urlHelper->generate('wish.and.get')]);
            }

            $this->cartService->deleteCart($postedData['delete'], $session);

            return new JsonResponse(['url' => $this->urlHelper->generate('store')]);
        }


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
        $productOutput = $this->cartService->getALLCartByproductIds($finalProductIdsCollection);

        $total = 0;
        foreach ($productOutput as $item) {
            $total += (int)$item['price'];
        }

        $data = [
            'products' => $productOutput,
            'cartProduct' => $productOutput,
            'totalPrice' => $total,
        ];


        return new HtmlResponse(
            $this->template->render(
                'product::store',
                $data
            )
        );
    }
}
