<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;

use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminGetCategoryPageHandler implements RequestHandlerInterface
{
    private const PAGE_SIZE = 6;

    public function __construct(
        private ?TemplateRendererInterface $template,
        private CategoryService $adminCategoryService,
        private ProductService $adminProductService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();

            $this->adminProductService->deleteProductWithCategory_id($adminPostedData['delete']);
            $this->adminCategoryService->deleteCategory($adminPostedData['delete']);
        }


        $page = $_GET['page'] ?? 1;

        $offset = ((int)($page ?? 1) * self::PAGE_SIZE) - self::PAGE_SIZE;
        if ($offset <= -1) {
            header('location:/admin/get/category/');
            die;
        }
        $categoryOutput = $this->adminCategoryService->getALlCategoryWithOffset($offset);
        $countMaterial = $this->adminCategoryService->count();
        $count = ceil($countMaterial['count'] / self::PAGE_SIZE);

        if ($page > $count) {
            header('location:/admin/get/category/');
            die;
        }

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'categories' => $categoryOutput,
            'pageCount' => $count,
            'current' => $page,
        ];

        return new HtmlResponse(
            $this->template->render(
                'showProduct::showCategory',
                $data
            )
        );
    }
}
