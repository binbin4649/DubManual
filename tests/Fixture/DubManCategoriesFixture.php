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
 * DubManCategoriesFixture
 */
class DubManCategoriesFixture extends TestFixture
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
                'sort_order' => 1,
                'article' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_publish' => 1,
                'created' => '2024-10-05 17:47:17',
                'modified' => '2024-10-05 17:47:17',
            ],
        ];
        parent::init();
    }
}
