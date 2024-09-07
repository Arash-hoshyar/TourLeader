<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Services\Product\MaterialService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminAddMaterialPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminAddMaterialPageHandler
    {
        return new AdminAddMaterialPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(MaterialService::class),
            $container->get(UrlHelper::class),
        );
    }
}
