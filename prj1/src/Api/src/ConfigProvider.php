<?php

declare(strict_types=1);

namespace Api;

use Api\Handler\ProductApiHandler;
use Api\Handler\ProductApiHandlerFactory;
use Api\Handler\ProductBySearchApiHandler;
use Api\Handler\ProductBySearchApiHandlerFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories' => [
                //PageHandler
                ProductApiHandler::class => ProductApiHandlerFactory::class,
                ProductBySearchApiHandler::class => ProductBySearchApiHandlerFactory::class,

                //AuthorizationService

                //AuthenticationMiddleware

                //GateWay

            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'extension' => 'twig',
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'index' => [__DIR__ . '/../templates/app/index'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
