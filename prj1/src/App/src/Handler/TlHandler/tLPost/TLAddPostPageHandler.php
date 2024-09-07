<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tLPost;

use Admin\Form\addProduct\AdminAddBrandForm;
use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use App\Services\TL\JourneyService;
use App\Services\TL\PostService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class TLAddPostPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private PostService $postService,
        private ImageService $imageService,
        private UrlHelper $urlHelper,
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postData = array_merge_recursive(
                $request->getUploadedFiles(),
                $request->getParsedBody()
            );


                $target_dir = realpath($_SERVER['DOCUMENT_ROOT']) . "/TourLeaderAsset/img/";
                $logo = $this->imageService->getImg($target_dir);
                $this->postService->addPost($postData['lable'], $logo, $postData['about']);
        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];

        return new HtmlResponse(
            $this->template->render(
                'post::addPost',
                $data
            )
        );
    }
}
