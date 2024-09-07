<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Form\addProduct\AdminAddBrandForm;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminAddBrandPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private BrandService $adminBrandService,
        private ImageService $imageService,
        private UrlHelper $urlHelper,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postData = array_merge_recursive(
                $request->getUploadedFiles(),
                $request->getParsedBody()
            );

            $brandFrom = new AdminAddBrandForm();
           $brandFrom->setData($postData);


            if ($brandFrom->isValid()) {
                $target_dir = realpath($_SERVER['DOCUMENT_ROOT']) . "/adminAsset/img/";
                $logo = $this->imageService->getImg($target_dir);
                $this->adminBrandService->adminAddBrand($postData['name'], $logo, $postData['url']);
                return new JsonResponse(['urlPj' => $this->urlHelper->generate('admin.add.brand')]);
            }
            return new JsonResponse($brandFrom->getMessages());
        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];

        return new HtmlResponse(
            $this->template->render(
                'product::addBrand',
                $data
            )
        );
    }
}
