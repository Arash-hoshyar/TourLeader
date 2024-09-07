<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;

use Admin\Form\addProduct\AdminAddMaterialForm;
use Admin\Form\EditProduct\AdminEditMaterialForm;
use Admin\Services\Product\MaterialService;
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


class AdminEditMaterialPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private MaterialService $materialService,
        private UrlHelper $urlHelper,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();
            $adminEditMaterialForm = new AdminEditMaterialForm();
            $adminEditMaterialForm->setData($adminPostedData);


            if ($adminEditMaterialForm->isValid()) {
                $materialData = $adminEditMaterialForm->getData(FormInterface::VALUES_AS_ARRAY);

                $this->materialService->updateMaterialById((int)$materialData['id'], $materialData['name']);
                return new JsonResponse(['url' => $this->urlHelper->generate('admineditmaterial') . '?id=' . $materialData['id']], StatusCodeInterface::STATUS_OK);
            }
            return new JsonResponse($adminEditMaterialForm->getMessages());
        }
        $materialId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($materialId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getMaterial = $this->materialService->getMaterial($materialId);

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'material' => $getMaterial,
        ];

        return new HtmlResponse(
            $this->template->render(
                'editProduct::editMaterial',
                $data
            )
        );
    }
}
