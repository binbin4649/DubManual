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

namespace DubManual\Event;

use BaserCore\Event\BcControllerEventListener;
use Cake\Event\Event;

/**
 * DubManual Controller Event Listener
 */
class DubManualControllerEventListener extends BcControllerEventListener
{

    /**
     * events
     * @var string[]
     */
    public $events = [
        //'Users.startup',
    ];

    /**
     * Services
     * @param Event $event
     */
    /*public function usersStartup(Event $event): void
    {
        // Add your logic here
    }*/

}