<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;

use Admin\Services\Product\MaterialService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\ProductMaterialCategoryService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminGetMaterialPageHandler implements RequestHandlerInterface
{
    private const PAGE_SIZE = 6;


    public function __construct(
        private ?TemplateRendererInterface $template,
        private MaterialService $materialService,
        private ProductMaterialCategoryService $productMaterialCategoryService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();

            $this->productMaterialCategoryService->deleteMaterialByMaterialId((int)$adminPostedData['delete']);
            $this->materialService->deleteMaterial($adminPostedData['delete']);
        }

        $page = $_GET['page'] ?? 1;

        $offset = ((int)($page ?? 1) * self::PAGE_SIZE) - self::PAGE_SIZE;
        if ($offset <= -1) {
            header('location:/admin/get/material/');
            die;
        }
        $materialOutput = $this->materialService->getALlMaterialWithOffset($offset);
        $countMaterial = $this->materialService->count();
        $count = ceil($countMaterial['count'] / self::PAGE_SIZE);

        if ($page > $count) {
            header('location:/admin/get/material/');
            die;
        }

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'materials' => $materialOutput,
            'pageCount' => $count,
            'current' => $page,
        ];

        return new HtmlResponse(
            $this->template->render(
                'showProduct::showMaterial',
                $data
            )
        );
    }
}
