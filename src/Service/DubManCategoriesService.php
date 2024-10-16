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

namespace DubManual\Service;

use Cake\ORM\TableRegistry;

/**
 * DubManCategories Service
 */
class DubManCategoriesService implements DubManCategoriesServiceInterface
{

    protected $DubManCategories;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->DubManCategories = TableRegistry::getTableLocator()->get('DubManual.DubManCategories');
    }

    /**
     * get new
     * @return \Cake\Datasource\EntityInterface
     */
    public function getNew(): \Cake\Datasource\EntityInterface
    {
        return $this->DubManCategories->newEntity([], [
            'validate' => false,
        ]);
    }

    /**
     * get
     * @param int $id
     * @param array $options
     * @return \Cake\Datasource\EntityInterface
     */
    public function get(int $id, array $options = []): \Cake\Datasource\EntityInterface
    {
        return $this->DubManCategories->get($id, [
            'contain' => [],
        ]);
    }

    /**
     * get list
     * @param array $queryParams
     * @return array
     */
    public function getList(array $queryParams = []): array
    {
        return $this->createConditions($this->DubManCategories->find('list'), $queryParams)->toArray();
    }

    /**
     * get index
     * @return \Cake\Datasource\QueryInterface
     */
    public function getIndex(): \Cake\Datasource\QueryInterface
    {
        // return $this->createConditions($this->DubManCategories->find()->contain(['DubManTopics.DubManArticles']));

        return $this->createConditions(
            $this->DubManCategories->find()
                ->contain(['DubManTopics.DubManArticles'])
                ->orderBy(['DubManCategories.sort_order' => 'ASC'])
        );
    }

    /**
     * create conditions
     * @param \Cake\Datasource\QueryInterface $query
     * @return \Cake\Datasource\QueryInterface
     */
    public function createConditions(\Cake\Datasource\QueryInterface $query, array $queryParams = [])
    {
        return $query;
    }

    /**
     * create
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function create(array $postData): ?\Cake\Datasource\EntityInterface
    {
        $entity = $this->DubManCategories->newEntity($postData);
        return $this->DubManCategories->saveOrFail($entity);
    }

    /**
     * edit
     * @param \Cake\Datasource\EntityInterface $target
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function update(\Cake\Datasource\EntityInterface $target, array $postData): ?\Cake\Datasource\EntityInterface
    {
        $user = $this->DubManCategories->patchEntity($target, $postData);
        return $this->DubManCategories->saveOrFail($user);
    }

    /**
     * delete
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->get($id);
        return $this->DubManCategories->delete($user);
    }
}
