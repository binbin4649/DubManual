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

namespace DubManual\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DubManTopicsFixture
 */
class DubManTopicsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                // 'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'category_id' => 1,
                'sort_order' => 1,
                'is_publish' => 1,
                'created' => '2024-10-05 17:47:26',
                'modified' => '2024-10-05 17:47:26',
            ],
        ];
        parent::init();
    }
}
