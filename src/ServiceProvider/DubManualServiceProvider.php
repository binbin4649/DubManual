<?php

declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.7
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace DubManual\ServiceProvider;

use Cake\Core\ServiceProvider;
use DubManual\Service\Admin\DubManArticlesAdminService;
use DubManual\Service\Admin\DubManArticlesAdminServiceInterface;
use DubManual\Service\Admin\DubManCategoriesAdminService;
use DubManual\Service\Admin\DubManCategoriesAdminServiceInterface;
use DubManual\Service\Admin\DubManTopicsAdminService;
use DubManual\Service\Admin\DubManTopicsAdminServiceInterface;
use DubManual\Service\DubManArticlesService;
use DubManual\Service\DubManArticlesServiceInterface;
use DubManual\Service\DubManCategoriesService;
use DubManual\Service\DubManCategoriesServiceInterface;
use DubManual\Service\DubManTopicsService;
use DubManual\Service\DubManTopicsServiceInterface;

/**
 * DubManual Service Provider
 */
class DubManualServiceProvider extends ServiceProvider
{

    /**
     * Provides
     * @var string[]
     */
    protected array $provides = [
        //TableNameAdminServiceInterface::class,
        DubManArticlesAdminServiceInterface::class,
        DubManArticlesServiceInterface::class,
        DubManCategoriesAdminServiceInterface::class,
        DubManCategoriesServiceInterface::class,
        DubManTopicsAdminServiceInterface::class,
        DubManTopicsServiceInterface::class,
    ];

    /**
     * Services
     * @param \Cake\Core\ContainerInterface $container
     */
    public function services($container): void
    {
        $container->defaultToShared(true);
        $container->add(DubManArticlesAdminServiceInterface::class, DubManArticlesAdminService::class);
        $container->add(DubManArticlesServiceInterface::class, DubManArticlesService::class);
        $container->add(DubManCategoriesAdminServiceInterface::class, DubManCategoriesAdminService::class);
        $container->add(DubManCategoriesServiceInterface::class, DubManCategoriesService::class);
        $container->add(DubManTopicsAdminServiceInterface::class, DubManTopicsAdminService::class);
        $container->add(DubManTopicsServiceInterface::class, DubManTopicsService::class);
    }
}
