<?php

declare(strict_types=1);

namespace Admin\Handler\indexHandler;


use App\Services\UserService\UserPurchaseInfoService;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminHomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private UserPurchaseInfoService $userPurchaseInfoService,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $product = $this->userPurchaseInfoService->getALLProduct();

        $data = [
            'product' => $product,
        ];

        return new HtmlResponse(
            $this->template->render(
                'index::index',
                $data
            )
        );
    }
}
