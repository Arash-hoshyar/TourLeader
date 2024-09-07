<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tours;

use Admin\Form\addProduct\AdminAddBrandForm;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use App\Services\TL\JourneyService;
use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TourService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class TLAddTourPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TourService $tourService,
        private ImageService $imageService,
        private UrlHelper $urlHelper,
        private TLAuthorizationService $authorizationService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postData = array_merge_recursive(
                $request->getUploadedFiles(),
                $request->getParsedBody()
            );
            if (isset($_SESSION['admin_email'])){
                $session = $_SESSION['tl_email'];
            }
            $user = $this->authorizationService->loginWithEmail($_SESSION['tl_email']);



            $target_dir = realpath($_SERVER['DOCUMENT_ROOT']) . "/TourLeaderAsset/img/";
            $logo = $this->imageService->getImg($target_dir);
            $this->tourService->addTour(
                $postData['lable'],
                $logo,
                (int)$postData['price'],
                (int)$postData['days'],
                $postData['place'],
                $postData['about'],
                $user['Name'],
            );
        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];

        return new HtmlResponse(
            $this->template->render(
                'addTour::addTour',
                $data
            )
        );
    }
}
