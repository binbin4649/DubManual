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

namespace DubManual\View\Helper;

use BaserCore\View\Helper\BcPluginBaserHelperInterface;
use Cake\View\Helper;

/**
 * DubManual Baser Helper
 */
class DubManualBaserHelper extends Helper implements BcPluginBaserHelperInterface
{

    /**
     * Helper
     * @var array
     */
    //public array $helpers = ['DubManual.DubManual'];

    /**
     * Method
     * @return array[]
     */
    public function methods(): array
    {
        return [
            //'getDubManualIndex' => ['DubManual', 'getIndex'],
        ];
    }

}
