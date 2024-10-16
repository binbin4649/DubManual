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

namespace DubManual\Service\Admin;

/**
 * DubManTopics Admin Service Interface
 */
interface DubManTopicsAdminServiceInterface extends \DubManual\Service\DubManTopicsServiceInterface
{

    /**
     * get view vars for index
     * @param \Cake\Datasource\Paging\PaginatorInterface $dubManTopics
     * @return array
     */
    public function getViewVarsForIndex(\Cake\Datasource\Paging\PaginatorInterface $dubManTopics): array;

    /**
     * get view vars for add
     * @param \Cake\Datasource\EntityInterface $dubManTopic
     * @return array
     */
    public function getViewVarsForAdd(\Cake\Datasource\EntityInterface $dubManTopic): array;

    /**
     * get view vars for edit
     * @param \Cake\Datasource\EntityInterface $dubManTopic
     * @return array
     */
    public function getViewVarsForEdit(\Cake\Datasource\EntityInterface $dubManTopic): array;

    /**
     * get view vars for view
     * @return array
     */
    public function getViewVarsForView(\Cake\Datasource\EntityInterface $dubManTopic): array;

}
