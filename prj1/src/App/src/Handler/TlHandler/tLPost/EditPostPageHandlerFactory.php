<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tLPost;


use App\Handler\TlHandler\journey\EditJourneyPageHandler;
use App\Services\TL\invokebles\TLImageService;
use App\Services\TL\JourneyService;
use App\Services\TL\PostService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class EditPostPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): EditPostPageHandler
    {
        return new EditPostPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(PostService::class),
            $container->get(TLImageService::class),
        );
    }
}
