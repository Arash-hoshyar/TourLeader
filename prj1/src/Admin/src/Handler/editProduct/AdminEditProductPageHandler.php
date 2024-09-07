<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;

use Admin\Form\addProduct\AdminAddProductForm;
use Admin\Form\EditProduct\AdminEditProductForm;
use Admin\Services\Product\BrandService;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminEditProductPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService $adminProductService,
        private BrandService $adminBrandService,
        private CategoryService $adminCategoryService,
        private MaterialService $materialService,
        private ProductMaterialCategoryService $productMaterialCategoryService,
        private UrlHelper $urlHelper,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();

            $adminEditProductForm = new AdminEditProductForm();
            $adminEditProductForm->setData($adminPostedData);


            if ($adminEditProductForm->isValid()) {
                $productData = $adminEditProductForm->getData(FormInterface::VALUES_AS_ARRAY);

                if (!empty($adminPostedData['material'])) {
                    $this->productMaterialCategoryService->deleteMaterial((int)$productData['id']);
                    foreach ($adminPostedData['material'] as $item) {
                        $this->productMaterialCategoryService->insertProductMaterialCategoryById(
                            (int)$productData['id'],
                            $productData['category_id'],
                            $item
                        );
                    }
                }
                $price = (int)$productData['price'];

                $this->adminProductService->updateProductById(
                    (int)$productData['id'],
                    $productData['name'],
                    $productData['label'],
                    $productData['brand_id'],
                    $productData['description'],
                    $price,
                    $productData['height'],
                    $productData['width'],
                    $productData['category_id'],
                    $productData['package']
                );
                return new JsonResponse(['url' => $this->urlHelper->generate('admineditproduct'). '?id=' . $productData['id']]);
            }
            return new JsonResponse($adminEditProductForm->getMessages());
        }


        $productId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($productId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }
        $productOutput = $this->adminProductService->getProduct($productId);


        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'brands' => $this->adminBrandService->getAllBrands(),
            'categories' => $this->adminCategoryService->getAllCategory(),
            'materials' => $this->materialService->getALLMaterial(),
            'product' => $productOutput
        ];

        return new HtmlResponse(
            $this->template->render(
                'editProduct::editProduct',
                $data
            )
        );
    }
}
