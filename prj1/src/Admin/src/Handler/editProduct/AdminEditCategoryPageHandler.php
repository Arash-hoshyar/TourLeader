<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;

use Admin\Form\EditProduct\AdminEditCategoryForm;
use Admin\Services\Product\CategoryService;
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


class AdminEditCategoryPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private CategoryService $adminCategoryService,
        private UrlHelper $urlHelper,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();
            $adminEditCategoryForm = new AdminEditCategoryForm();
            $adminEditCategoryForm->setData($adminPostedData);


            if ($adminEditCategoryForm->isValid()) {
                $materialData = $adminEditCategoryForm->getData(FormInterface::VALUES_AS_ARRAY);

                $this->adminCategoryService->updateCategoryById((int)$materialData['id'], $materialData['name']);
                return new JsonResponse(['url' => $this->urlHelper->generate('admineditcategory') . '?id=' . $materialData['id']]);
            }

            return new JsonResponse($adminEditCategoryForm->getMessages());
        }
        $categoryId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($categoryId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getCategory = $this->adminCategoryService->getCategory($categoryId);

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'category' => $getCategory,
        ];

        return new HtmlResponse(
            $this->template->render(
                'editProduct::editCategory',
                $data
            )
        );
    }
}
