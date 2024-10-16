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

namespace DubManual\Model\Entity;

use Cake\ORM\Entity;

/**
 * DubManArticle Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int $topic_id
 * @property string|null $article
 * @property string|null $img
 * @property int $sort_order
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class DubManArticle extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'topic_id' => true,
        'article' => true,
        'img' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
    ];
}
