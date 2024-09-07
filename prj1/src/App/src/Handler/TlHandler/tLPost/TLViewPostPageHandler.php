<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tLPost;


use Admin\Services\Product\CategoryService;
use Admin\Services\Product\ProductService;
use Admin\Services\productRelated\TopSellerService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\TL\JourneyService;
use App\Services\TL\MassageService;
use App\Services\TL\PostService;
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

class TLViewPostPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private PostService $postService,
        private MassageService $massageService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $PostedData = $request->getParsedBody();

            $this->massageService->addMassage((int)$PostedData['id'],$PostedData['name'],$PostedData['lable'],$PostedData['massage']);

        }



            $journeyId = (int)$request->getqueryParams()['id'] ?? 0;


        if ($journeyId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }
        $massage = $this->massageService->allMassageById($journeyId);

        $getJourney = $this->postService->getPost($journeyId);

        $data = [
            'post' => $getJourney,
            'massages' => $massage,
        ];

        return new HtmlResponse(
            $this->template->render(
                'post::contact',
                $data
            )
        );
    }
}
