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
 * DubManTopics Service
 */
class DubManTopicsService implements DubManTopicsServiceInterface
{

    protected $DubManTopics;
    protected $DubManCategories;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->DubManTopics = TableRegistry::getTableLocator()->get('DubManual.DubManTopics');
        $this->DubManCategories = TableRegistry::getTableLocator()->get('DubManual.DubManCategories');
    }

    /**
     * get category by id
     * @param string $categoryId
     * @return \Cake\Datasource\EntityInterface
     */
    public function getCategoryById(string $categoryId): \Cake\Datasource\EntityInterface
    {
        return $this->DubManCategories->get($categoryId);
    }

    /**
     * get new
     * @param string $categoryId
     * @return \Cake\Datasource\EntityInterface
     */
    public function getNew(string $categoryId = null): \Cake\Datasource\EntityInterface
    {
        return $this->DubManTopics->newEntity([
            'category_id' => $categoryId,
        ], [
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
        $options['contain'] = ['DubManArticles'];
        return $this->DubManTopics->get($id, $options);
    }

    /**
     * get list
     * @param array $queryParams
     * @return array
     */
    public function getList(array $queryParams = []): array
    {
        return $this->createConditions($this->DubManTopics->find('list'), $queryParams)->toArray();
    }

    /**
     * getArticlesに置き換えたので要らない
     * get index
     * @param int $id
     * @return \Cake\Datasource\QueryInterface
     */
    public function getIndex(int $id = null): \Cake\Datasource\QueryInterface
    {
        return $this->createConditions(
            $this->DubManTopics->find()
                ->where(['DubManTopics.id' => $id])
                ->contain(['DubManArticles'])
                ->orderBy(['DubManTopics.sort_order' => 'ASC'])
                ->limit(1)
        );
    }

    /**
     * getArticles
     * @param int $id
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function getArticles(int $id): ?\Cake\Datasource\EntityInterface
    {
        $options['contain'] = [
            'DubManArticles'
        ];
        $topic = $this->DubManTopics->get($id, $options);
        if (empty($topic->dub_man_articles)) {
            return null;
        }
        return $topic;
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
        $entity = $this->DubManTopics->newEntity($postData);
        return $this->DubManTopics->saveOrFail($entity);
    }

    /**
     * edit
     * @param \Cake\Datasource\EntityInterface $target
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function update(\Cake\Datasource\EntityInterface $target, array $postData): ?\Cake\Datasource\EntityInterface
    {
        $user = $this->DubManTopics->patchEntity($target, $postData);
        return $this->DubManTopics->saveOrFail($user);
    }

    /**
     * delete
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->get($id);
        return $this->DubManTopics->delete($user);
    }
}
