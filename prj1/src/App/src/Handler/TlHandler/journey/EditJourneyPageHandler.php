<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\journey;

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


            $this->journeyService->updateJourneyById((int)$PostedData['id'], $PostedData['lable'], $PostedData['about'], $logo);
        }

        $journeyId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($journeyId === 0) {

            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getJourney = $this->journeyService->getJourney($journeyId);

        $data = [
            'email' => $_SESSION['admin_email'] ?? '',
            'journey' => $getJourney,
        ];

        return new HtmlResponse(
            $this->template->render(
                'addJourney::editJourney',
                $data
            )
        );
    }
}
