<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\tours;


use App\Handler\TlHandler\journey\EditJourneyPageHandler;
use App\Services\TL\invokebles\TLImageService;
use App\Services\TL\JourneyService;
use App\Services\TL\TourService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class EditTourPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): EditTourPageHandler
    {
        return new EditTourPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(TourService::class),
            $container->get(TLImageService::class),
        );
    }
}
