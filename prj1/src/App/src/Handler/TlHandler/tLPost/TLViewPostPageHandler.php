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
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLViewTourPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TourService $tourService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {$journeyId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($journeyId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $getJourney = $this->tourService->getTour($journeyId);

        $data = [
            'tour' => $getJourney,
        ];

        return new HtmlResponse(
            $this->template->render(
                'addTour::tour',
                $data
            )
        );
    }
}
