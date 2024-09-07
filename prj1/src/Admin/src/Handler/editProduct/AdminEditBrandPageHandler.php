<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;

use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\UploadedFile;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminEditBrandPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private BrandService          $adminBrandService,
        private ImageService        $imageService,
    )
    {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {

            $adminPostedData = $request->getParsedBody();

            $uploadedFiles = $request->getUploadedFiles();

            $target_dir = realpath($_SERVER['DOCUMENT_ROOT']) . "/adminAsset/img/";

            $logo = null;
            /** @var UploadedFile $uploadedFile */
            foreach ($uploadedFiles as $uploadedFile) {
                if ($uploadedFile->getError() === 0) {
                    $logo = $this->imageService->getImg($target_dir);
                }
            }


            $this->adminBrandService->updateBrandById((int)$adminPostedData['id'], $adminPostedData['name'], $adminPostedData['url'], $logo);
        }

        $brandId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($brandId === 0) {

            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getBrand = $this->adminBrandService->getBrand($brandId);
        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'brand' => $getBrand,
        ];

        return new HtmlResponse(
            $this->template->render(
                'editProduct::editBrand',
                $data
            )
        );
    }
}
