<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;


use Admin\Services\Product\MaterialService;
use Laminas\Diactoros\Uri;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminEditMaterialPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminEditMaterialPageHandler
    {
        return new AdminEditMaterialPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(MaterialService::class),
            $container->get(UrlHelper::class),
        );
    }
}
