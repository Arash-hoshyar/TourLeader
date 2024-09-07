<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Form\addProduct\AdminAddProductForm;
use Admin\Services\Product\BrandService;
use Admin\Services\Product\CategoryService;
use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminAddProductPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService $adminProductService,
        private BrandService $adminBrandService,
        private CategoryService $adminCategoryService,
        private MaterialService $materialService,
        private UrlHelper $urlHelper,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();
            $adminAddProductForm = new AdminAddProductForm();
            $adminAddProductForm->setData($adminPostedData);


            if ($adminAddProductForm->isValid()) {
                $productData = $adminAddProductForm->getData(FormInterface::VALUES_AS_ARRAY);

                $price = (int)$productData['price'];
                $this->adminProductService->adminAddProduct(
                    $productData['name'],
                    $productData['label'],
                    $productData['brand_id'],
                    $productData['description'],
                    $price,
                    $productData['height'],
                    $productData['width'],
                    $adminPostedData['material'],
                    $productData['category_id'],
                    $productData['package']
                );
                return new JsonResponse(['url' => $this->urlHelper->generate('admin.add.product')]);
            }
                return new JsonResponse($adminAddProductForm->getMessages());
        }

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'brands' => $this->adminBrandService->getAllBrands(),
            'categories' => $this->adminCategoryService->getAllCategory(),
            'materials' => $this->materialService->getALLMaterial(),
        ];

        return new HtmlResponse(
            $this->template->render(
                'product::addProduct',
                $data
            )
        );
    }
}
