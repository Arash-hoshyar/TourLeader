<?php

declare(strict_types=1);

namespace Admin\Handler\editProduct;


use Admin\Services\Product\CategoryService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AdminEditCategoryPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): AdminEditCategoryPageHandler
    {
        return new AdminEditCategoryPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(CategoryService::class),
            $container->get(UrlHelper::class),
        );
    }
}
