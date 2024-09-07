<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Form\addProduct\AdminAddMaterialForm;
use Admin\Services\Product\MaterialService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminAddMaterialPageHandler implements RequestHandlerInterface
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
            $adminAddMaterialForm = new AdminAddMaterialForm();
            $adminAddMaterialForm->setData($adminPostedData);


            if ($adminAddMaterialForm->isValid()) {
                $materialData = $adminAddMaterialForm->getData(FormInterface::VALUES_AS_ARRAY);

                $this->materialService->addMaterial($materialData['name']);
                return new JsonResponse(['url' => $this->urlHelper->generate('admin.add.material')]);
            }
            return new JsonResponse($adminAddMaterialForm->getMessages());
        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];

        return new HtmlResponse(
            $this->template->render(
                'product::addMaterial',
                $data
            )
        );
    }
}
