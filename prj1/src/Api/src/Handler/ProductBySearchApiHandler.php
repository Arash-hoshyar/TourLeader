<?php

declare(strict_types=1);

namespace Api\Handler;

use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProductBySearchApiHandler implements RequestHandlerInterface
{

    public function __construct(
        private ProductService $adminProductService,
        private CategoryService $categoryService,
        private ?TemplateRendererInterface $templateRenderer,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $categoryName = ($request->getQueryParams()['category_id']);

        $categoryId = $this->categoryService->getCategoryByName($categoryName);

        if ($categoryId === null) {
            return new JsonResponse([]);
        }

        $products = $this->adminProductService->getALLProductByCategoryId($categoryId['id']);

        $data = [
            'products' => $products
        ];

        $finalHtml = $this->templateRenderer->render(
            'index::product_sliders',
            $data
        );
        return new HtmlResponse(
            $finalHtml
        );
    }
}