<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Form\addProduct\AdminAddCategoryForm;
use Admin\Services\Product\CategoryService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminAddCategoryPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private CategoryService       $adminCategoryService,
        private UrlHelper       $urlHelper,
    )
    {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {

            $adminPostedData = $request->getParsedBody();
            $adminAddCategoryForm = new AdminAddCategoryForm();
            $adminAddCategoryForm->setData($adminPostedData);


            if ($adminAddCategoryForm->isValid()) {
                $materialData = $adminAddCategoryForm->getData(FormInterface::VALUES_AS_ARRAY);
                $this->adminCategoryService->adminAddCategory($materialData['name']);
                return new JsonResponse(['url' => $this->urlHelper->generate('admin.add.category')]);
            }
            return new JsonResponse($adminAddCategoryForm->getMessages());


        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];

        return new HtmlResponse(
            $this->template->render(
                'product::addCategory',
                $data
            )
        );
    }
}
