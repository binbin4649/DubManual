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
 * DubManCategories Admin Service Interface
 */
interface DubManCategoriesAdminServiceInterface extends \DubManual\Service\DubManCategoriesServiceInterface
{
    /**
     * get view vars for index
     * @param \Cake\Datasource\Paging\PaginatorInterface $dubManCategories
     * @return array
     */
    public function getViewVarsForIndex(\Cake\Datasource\Paging\PaginatorInterface $dubManCategories): array;

    /**
     * get view vars for add
     * @param \Cake\Datasource\EntityInterface $dubManCategory
     * @return array
     */
    public function getViewVarsForAdd(\Cake\Datasource\EntityInterface $dubManCategory): array;

    /**
     * get view vars for edit
     * @param \Cake\Datasource\EntityInterface $dubManCategory
     * @return array
     */
    public function getViewVarsForEdit(\Cake\Datasource\EntityInterface $dubManCategory): array;

    /**
     * get view vars for view
     * @return array
     */
    public function getViewVarsForView(\Cake\Datasource\EntityInterface $dubManCategory): array;
}
