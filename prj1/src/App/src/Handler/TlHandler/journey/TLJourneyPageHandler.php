<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\journey;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\TL\JourneyService;
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

class TLJourneyPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private JourneyService $journeyService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $PostedData = $request->getParsedBody();

            $this->journeyService->deleteJourney($PostedData['delete']);
        }

        $journey = $this->journeyService->getALLJourney();

        $data = [
            'journeys' => $journey,
        ];

        return new HtmlResponse(
            $this->template->render(
                'tourGuid::destination',
                $data
            )
        );
    }
}
