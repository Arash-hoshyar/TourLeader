<?php

declare(strict_types=1);

namespace Admin\Handler\addProduct;

use Admin\Services\Product\CategoryService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminAddCategoryPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminAddCategoryPageHandler
    {
        return new AdminAddCategoryPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(CategoryService::class),
            $container->get(UrlHelper::class),
        );
    }
}
