<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;


use Admin\Services\invokables\ImageService;
use Admin\Services\Product\BrandService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminEditBrandPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminEditBrandPageHandler
    {
        return new AdminEditBrandPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(BrandService::class),
            $container->get(ImageService::class),
        );
    }
}
