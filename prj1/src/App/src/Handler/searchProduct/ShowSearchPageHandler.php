<?php

declare(strict_types=1);

namespace App\Handler\searchProduct;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use App\Services\CartService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ShowSearchPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService $adminProductService,
        private CartService $cartService,
        private CategoryService $adminCategoryService,
        private MaterialService $materialService,
        private ProductMaterialCategoryService $productMaterialCategoryService,
        private UrlHelper $urlHelper,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $productOutput = $this->adminProductService->getAllProduct();

        /// post
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();

            $cookie = $_COOKIE['PHPSESSID'];
            $session = null;


            if (isset($_SESSION['user_email'])) {
                $session = $_SESSION['user_email'];
                $cookie = null;
            }

            if (isset($postedData['value'])) {
                $this->cartService->addCart((int)$postedData['value'], $session, $cookie);


                return new JsonResponse(['url' => $this->urlHelper->generate('AddToCart')]);
            }

            $finalMaterialIdsCollection = '';
            $finalCategoryIdsCollection = '';

            if (isset($postedData['material'])) {
                $finalMaterialIdsCollection = (implode(',', $postedData['material']));
            }
            if (isset($postedData['category'])) {
                $finalCategoryIdsCollection = (implode(',', $postedData['category']));
            }
            $productIdsByMaterial = $this->productMaterialCategoryService->selectByMaterialAndCategory(
                $finalMaterialIdsCollection,
                $finalCategoryIdsCollection
            );
            $productIdsByMaterialCollection = [];

            foreach ($productIdsByMaterial as $item) {
                $productIdsByMaterialCollection [] = (int)$item['product_id'];
            }
            $finalProductIdsCollection = (implode(',', $productIdsByMaterialCollection));
            $productOutput = $this->cartService->getALLCartByproductIds($finalProductIdsCollection);
        }

        //end post


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

        $categories = $this->adminCategoryService->getAllCategory();
        $materials = $this->materialService->getAllMaterial();

        $data = [
            'products' => $productOutput,
            'cartProduct' => $addedProductOutput,
            'totalPrice' => $total,
            'categories' => $categories,
            'materials' => $materials,
        ];

        return new HtmlResponse(
            $this->template->render(
                'search::productSearch',
                $data
            )
        );
    }
}
