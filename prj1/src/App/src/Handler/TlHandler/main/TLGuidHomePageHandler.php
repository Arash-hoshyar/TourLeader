<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\main;


use App\Services\TL\TLAuthorizationService;
use App\Services\TL\TourService;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLGuidHomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TLAuthorizationService $tLAuthorizationService,
        private TourService $tourService,

    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tLInfo = $this->tLAuthorizationService->TLInfo($_SESSION['tl_email']);
        $tour = $this->tourService->getALLTour();

        $data = [
            'email' => $_SESSION['tl_email'] ?? '',
            'info' => $tLInfo,
            'tours' => $tour,

        ];

        return new HtmlResponse(
            $this->template->render(
                'tourGuid::about',
                $data
            )
        );
    }
}
