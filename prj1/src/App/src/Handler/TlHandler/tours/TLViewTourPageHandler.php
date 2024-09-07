<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tours;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\TL\JourneyService;
use App\Services\TL\TourService;
use App\Services\UserService\UserPurchaseInfoService;
use App\Services\WishListService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLTourPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TourService $tourService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $PostedData = $request->getParsedBody();

            $this->tourService->deleteTour($PostedData['delete']);
        }

        $journey = $this->tourService->getALLTour();

        $data = [
            'tours' => $journey,
        ];

        return new HtmlResponse(
            $this->template->render(
                'tourGuid::tourList',
                $data
            )
        );
    }
}
