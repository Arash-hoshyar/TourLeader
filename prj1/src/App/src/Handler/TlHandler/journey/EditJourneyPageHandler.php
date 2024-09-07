<?php

declare(strict_types=1);

namespace App\DB\TlDB;

use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use App\Services\TL\invokebles\TLImageService;
use App\Services\TL\JourneyService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\UploadedFile;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class EditJourneyPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private JourneyService          $journeyService,
        private TLImageService        $imageService,
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


            $this->journeyService->updateJourneyById((int)$adminPostedData['id'], $adminPostedData['name'], $adminPostedData['url'], $logo);
        }

        $journeyId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($journeyId === 0) {

            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getjourney = $this->journeyService->getJourney($journeyId);
        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'brand' => $getjourney,
        ];

        return new HtmlResponse(
            $this->template->render(
                'editProduct::editBrand',
                $data
            )
        );
    }
}
