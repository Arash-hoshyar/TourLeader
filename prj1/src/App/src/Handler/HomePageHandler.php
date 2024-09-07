<?php

declare(strict_types=1);

namespace App\Handler;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
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

class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService $adminProductService,
        private UrlHelper $urlHelper,
        private CartService $cartService,
        private CategoryService $adminCategoryService,
        private WishListService $wishListService,
        private TopSellerService $topSellerService,
        private CartPriceService $cartPriceService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = session_id();

        if (isset($_SESSION['user_email'])) {
            $session = $_SESSION['user_email'];
        }
        /// post
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();

            if (isset($postedData['value'])) {
                $productPrice = $this->adminProductService->getProduct((int)$postedData['value']);
                $count = 1;

                $this->cartService->addCart((int)$postedData['value'], $session);

                $this->cartPriceService->addCart((int)$postedData['value'], (int)$productPrice['price'], $session,$count);


                return new JsonResponse(['url' => $this->urlHelper->generate('AddToCart')]);
            }

            if (isset($postedData['wishListValue'])) {
                $this->wishListService->addWishlist((int)$postedData['wishListValue'], $session);


                return new JsonResponse(['url' => $this->urlHelper->generate('wish.and.get')]);
            }
        }

        //end post


        $productOutput = $this->adminProductService->getAllProduct();
        $topSellerProductOutput = $this->topSellerService->getALLTopSeller();

        $topSellerIdsCollection = [];

        foreach ($topSellerProductOutput as $item) {
            $topSellerIdsCollection [] = (int)$item['product_id'];
        }
        $finalTopSellerIdsCollection = (implode(',', $topSellerIdsCollection));

        $topSellerOutput = $this->topSellerService->getALLProductById($finalTopSellerIdsCollection);

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

        $categories = $this->adminCategoryService->getAllCategory();


        $data = [
            'products' => $productOutput,
            'TopSellerProducts' => $topSellerOutput,
            'cartProduct' => $addedProductOutput,
            'totalPrice' => $total,
            'categories' => $categories,
        ];

        return new HtmlResponse(
            $this->template->render(
                'app::index',
                $data
            )
        );
    }
}
