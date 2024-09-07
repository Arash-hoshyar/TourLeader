<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tours;

use App\Services\TL\invokebles\TLImageService;
use App\Services\TL\JourneyService;
use App\Services\TL\TourService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\UploadedFile;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class EditTourPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TourService $tourService,
        private TLImageService $imageService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $PostedData = $request->getParsedBody();

            $uploadedFiles = $request->getUploadedFiles();

            $target_dir = realpath($_SERVER['DOCUMENT_ROOT']) . "/TourLeaderAsset/img/";

            $logo = null;
            /** @var UploadedFile $uploadedFile */
            foreach ($uploadedFiles as $uploadedFile) {
                if ($uploadedFile->getError() === 0) {
                    $logo = $this->imageService->getImg($target_dir);
                }
            }
            $this->tourService->updateTourById(
                (int)$PostedData['id'],
                $PostedData['lable'],
                (int)$PostedData['price'],
                (int)$PostedData['days'],
                $PostedData['place'],
                $PostedData['about'],
                $logo
            );
        }

        $journeyId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($journeyId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getJourney = $this->tourService->getTour($journeyId);

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'tour' => $getJourney,
        ];

        return new HtmlResponse(
            $this->template->render(
                'addTour::editTour',
                $data
            )
        );
    }
}
