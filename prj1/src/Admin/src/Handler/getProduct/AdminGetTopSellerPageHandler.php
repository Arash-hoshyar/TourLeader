<?php

declare(strict_types=1);

namespace Admin\Handler\getProduct;

use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminGetTopSellerPageHandler implements RequestHandlerInterface
{
    private const PAGE_SIZE = 6;

    public function __construct(
        private ?TemplateRendererInterface $template,
        private TopSellerService $topSellerService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();

            $this->topSellerService->deleteTopSeller($adminPostedData['delete']);
        }

        $page = $_GET['page'] ?? 1;

        $offset = ((int)($page ?? 1) * self::PAGE_SIZE) - self::PAGE_SIZE;
        if ($offset <= -1) {
            header('location:/admin/get/top/seller/');
            die;
        }
        $topSellerProductOutput = $this->topSellerService->getALlTopSellerWithOffset($offset);
        $countMaterial = $this->topSellerService->count();
        $count = ceil($countMaterial['count'] / self::PAGE_SIZE);

        if ($page > $count) {
            header('location:/admin/get/top/seller/');
            die;
        }


        $topSellerIdsCollection = [];

        foreach ($topSellerProductOutput as $item) {
            $topSellerIdsCollection [] = (int)$item['product_id'];
        }
        $finalTopSellerIdsCollection = (implode(',', $topSellerIdsCollection));

        $topSellerOutput = $this->topSellerService->getALLProductById($finalTopSellerIdsCollection);


        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'topSellers' => $topSellerOutput,
            'pageCount' => $count,
            'current' => $page,
        ];

        return new HtmlResponse(
            $this->template->render(
                'showProduct::showTopSeller',
                $data
            )
        );
    }
}
