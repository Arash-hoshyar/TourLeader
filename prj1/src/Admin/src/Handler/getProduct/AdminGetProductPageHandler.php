<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;

use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Admin\Services\productRelated\TopSellerService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminGetProductPageHandler implements RequestHandlerInterface
{
    private const PAGE_SIZE = 6;

    public function __construct(
        private ?TemplateRendererInterface $template,
        private ProductService $adminProductService,
        private ProductMaterialCategoryService $productMaterialCategoryService,
        private TopSellerService $topSellerService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();

            if (isset($adminPostedData['delete'])) {
                $this->productMaterialCategoryService->deleteMaterial((int)$adminPostedData['delete']);
                $this->adminProductService->deleteProduct($adminPostedData['delete']);
            }

            if (isset($adminPostedData['topSeller'])) {
                $this->topSellerService->addTopSeller((int)$adminPostedData['topSeller']);
            }
        }

        $page = $_GET['page'] ?? 1;

        $offset = ((int)($page ?? 1) * self::PAGE_SIZE) - self::PAGE_SIZE;
        if ($offset <= -1) {
            header('location:/admin/get/product/');
            die;
        }
        $productOutput = $this->adminProductService->getALlProductWithOffset($offset);
        $countProduct = $this->adminProductService->count();
        $count = ceil($countProduct['count'] / self::PAGE_SIZE);

        if ($page > $count) {
            header('location:/admin/get/product/');
            die;
        }

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'products' => $productOutput,
            'pageCount' => $count,
            'current' => $page,
        ];

        return new HtmlResponse(
            $this->template->render(
                'showProduct::showProduct',
                $data
            )
        );
    }
}
