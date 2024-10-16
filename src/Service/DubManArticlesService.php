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
 * DubManArticles Service
 */
class DubManArticlesService implements DubManArticlesServiceInterface
{

    protected $DubManArticles;
    protected $DubManTopics;
    /**
     * constructor
     */
    public function __construct()
    {
        $this->DubManArticles = TableRegistry::getTableLocator()->get('DubManual.DubManArticles');
        $this->DubManTopics = TableRegistry::getTableLocator()->get('DubManual.DubManTopics');
    }

    /**
     * get new
     * @param string $topicId
     * @return \Cake\Datasource\EntityInterface
     */
    public function getNew(string $topicId = null): \Cake\Datasource\EntityInterface
    {
        return $this->DubManArticles->newEntity([
            'topic_id' => $topicId,
        ], [
            'validate' => false,
        ]);
    }

    /**
     * get topic by id
     * @param string $topicId
     * @return \Cake\Datasource\EntityInterface
     */
    public function getTopicById(string $topicId): \Cake\Datasource\EntityInterface
    {
        $options['contain'] = 'DubManCategories';
        return $this->DubManTopics->get($topicId, $options);
    }

    /**
     * get
     * @param int $id
     * @param array $options
     * @return \Cake\Datasource\EntityInterface
     */
    public function get(int $id, array $options = []): \Cake\Datasource\EntityInterface
    {
        return $this->DubManArticles->get($id, $options);
    }

    /**
     * get list
     * @param array $queryParams
     * @return array
     */
    public function getList(array $queryParams = []): array
    {
        return $this->createConditions($this->DubManArticles->find('list'), $queryParams)->toArray();
    }

    /**
     * get index
     * @return \Cake\Datasource\QueryInterface
     */
    public function getIndex(array $queryParams = []): \Cake\Datasource\QueryInterface
    {
        return $this->createConditions($this->DubManArticles->find(), $queryParams);
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
        $img = $postData['img'];
        $postData['img'] = null;
        $entity = $this->DubManArticles->newEntity($postData);
        $savedEntity = $this->DubManArticles->saveOrFail($entity);
        $savedEntity = $this->handleFileUpload($img, $savedEntity);

        // if ($img instanceof \Laminas\Diactoros\UploadedFile) {
        //     $extension = pathinfo($img->getClientFilename(), PATHINFO_EXTENSION);
        //     $imgName = $savedEntity->id . '.' . $extension;
        //     $url = 'dub_manual/img/' . $imgName;
        //     $path = ROOT . DS . 'plugins' . DS . 'DubManual' . DS . 'webroot' . DS . 'img' . DS . $imgName;
        //     try {
        //         $img->moveTo($path);
        //         $savedEntity->img = $url;
        //         $this->DubManArticles->saveOrFail($savedEntity);
        //     } catch (\Exception $e) {
        //         $this->DubManArticles->delete($savedEntity);

        //         \Cake\Log\Log::error('画像のアップロードに失敗しました: ' . $e->getMessage());
        //         \Cake\Log\Log::error('path: ' . $path);
        //         throw new \Exception('画像のアップロードに失敗しました: ' . $e->getMessage());
        //     }
        // }

        return $savedEntity;
    }

    /**
     * edit
     * @param \Cake\Datasource\EntityInterface $target
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function update(\Cake\Datasource\EntityInterface $target, array $postData): ?\Cake\Datasource\EntityInterface
    {
        $img = $postData['img'];
        $postData['img'] = null;
        $user = $this->DubManArticles->patchEntity($target, $postData);
        $savedEntity = $this->DubManArticles->saveOrFail($user);
        $savedEntity = $this->handleFileUpload($img, $savedEntity);
        return $savedEntity;
    }

    /**
     * delete
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->get($id);
        return $this->DubManArticles->delete($user);
    }

    /**
     * 画像アップロード処理を行います。
     *
     * @param ?\Laminas\Diactoros\UploadedFile $img アップロードされた画像ファイル
     * @param \Cake\Datasource\EntityInterface $savedEntity 保存されたエンティティ
     * @return \Cake\Datasource\EntityInterface 保存されたエンティティ
     * @throws \Exception 画像アップロードに失敗した場合
     */
    private function handleFileUpload(?\Laminas\Diactoros\UploadedFile $img, \Cake\Datasource\EntityInterface $savedEntity): \Cake\Datasource\EntityInterface
    {
        if (!empty($img)) {
            // $tempFilePath = $img->getStream()->getMetadata('uri');
            // $fileInfo = pathinfo($tempFilePath);
            // $extension = $fileInfo['extension'];
            $extension = pathinfo($img->getClientFilename(), PATHINFO_EXTENSION);
            $imgName = $savedEntity->id . '.' . $extension;
            $url = '/dub_manual/img/' . $imgName;
            $path = ROOT . DS . 'plugins' . DS . 'DubManual' . DS . 'webroot' . DS . 'img' . DS . $imgName;
            try {
                $img->moveTo($path);
                $savedEntity->img = $url;
                $this->DubManArticles->saveOrFail($savedEntity);
            } catch (\Exception $e) {
                $this->DubManArticles->delete($savedEntity);

                \Cake\Log\Log::error('画像のアップロードに失敗しました: ' . $e->getMessage());
                \Cake\Log\Log::error('path: ' . $path);
                throw new \Exception('画像のアップロードに失敗しました: ' . $e->getMessage());
            }
        }
        return $savedEntity;
    }
}
