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
 * DubManArticles Admin Service Interface
 */
interface DubManArticlesAdminServiceInterface extends \DubManual\Service\DubManArticlesServiceInterface
{

    /**
     * get view vars for index
     * @param \Cake\Datasource\Paging\PaginatorInterface $dubManArticles
     * @return array
     */
    public function getViewVarsForIndex(\Cake\Datasource\Paging\PaginatorInterface $dubManArticles): array;

    /**
     * get view vars for add
     * @param \Cake\Datasource\EntityInterface $dubManArticle
     * @return array
     */
    public function getViewVarsForAdd(\Cake\Datasource\EntityInterface $dubManArticle): array;

    /**
     * get view vars for edit
     * @param \Cake\Datasource\EntityInterface $dubManArticle
     * @return array
     */
    public function getViewVarsForEdit(\Cake\Datasource\EntityInterface $dubManArticle): array;

    /**
     * get view vars for view
     * @return array
     */
    public function getViewVarsForView(\Cake\Datasource\EntityInterface $dubManArticle): array;

}