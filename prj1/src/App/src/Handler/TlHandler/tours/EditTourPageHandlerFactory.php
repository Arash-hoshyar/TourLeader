<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\journey;


use App\Services\TL\invokebles\TLImageService;
use App\Services\TL\JourneyService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class EditJourneyPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): EditJourneyPageHandler
    {
        return new EditJourneyPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(JourneyService::class),
            $container->get(TLImageService::class),
        );
    }
}
