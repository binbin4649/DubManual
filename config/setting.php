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

return [
    'BcApp' => [
        /**
         * System Navigation
         */
        'adminNavigation' => [
            'DubManual' => [
                'title' => __d('baser_core', 'DubManual'),
                'type' => 'contents',
                'menus' => [
                    'DubManualIndex' => [
                        'title' => __d('baser_core', 'DubManualIndex'),
                        'url' => [
                            'prefix' => 'Admin',
                            'plugin' => 'DubManual',
                            'controller' => 'DubManCategories',
                            'action' => 'index'
                        ]
                    ],
                    'bcaBtnIcon' => [
                        'title' => __d('baser_core', 'bcaBtnIcon'),
                        'url' => [
                            'prefix' => 'Admin',
                            'plugin' => 'DubManual',
                            'controller' => 'DubManCategories',
                            'action' => 'bcaBtnIcon'
                        ]
                    ]
                ]
            ]
        ]
    ]

    // Add your plugin's configuration here

];
