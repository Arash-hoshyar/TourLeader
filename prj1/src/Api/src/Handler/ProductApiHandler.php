<?php

declare(strict_types=1);

namespace Api\Handler;

use Admin\Services\Product\ProductService;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProductApiHandler implements RequestHandlerInterface
{

    public function __construct(
        private ProductService $adminProductService,
        private ?TemplateRendererInterface $templateRenderer,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $categoryId = (int)($request->getQueryParams()['category_id'] ?? 0);
        if ($categoryId === 0) {
            return new JsonResponse([]);
        }

        $products = $this->adminProductService->getALLProductByCategoryId($categoryId);
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