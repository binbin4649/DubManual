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
use Cake\Utility\Inflector;
use BaserCore\Utility\BcUtil;


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
        $target = $this->deleteImageIfRequested($target, $postData);
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
        $article = $this->get($id);
        $article = $this->deleteImageIfRequested($article, ['img_delete' => 1]);
        return $this->DubManArticles->delete($article);
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
        $theme = BcUtil::getCurrentTheme();
        $path = ROOT . DS . 'plugins' . DS . $theme . DS . 'webroot' . DS . 'img' . DS . 'DubManual';
        if ($img->getError() === UPLOAD_ERR_OK) {
            $extension = pathinfo($img->getClientFilename(), PATHINFO_EXTENSION);
            $imgName = $savedEntity->id . '.' . $extension;
            $url = '/' . Inflector::underscore($theme) . '/img/DubManual/' . $imgName;
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            try {
                $img->moveTo($path . DS . $imgName);
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

    /**
     * 画像削除リクエストがあった場合に画像を削除します。
     *
     * @param \Cake\Datasource\EntityInterface $target エンティティ
     * @param array $postData 投稿データ
     * @return \Cake\Datasource\EntityInterface エンティティ
     */
    public function deleteImageIfRequested(\Cake\Datasource\EntityInterface $target, array $postData): \Cake\Datasource\EntityInterface
    {
        if (!empty($postData['img_delete']) && $postData['img_delete'] == 1 && !empty($target->img)) {
            $theme = BcUtil::getCurrentTheme();
            $imgPath = ROOT . DS . 'plugins' . DS . $theme . DS . 'webroot' . DS . 'img' . DS . 'DubManual' . DS . basename($target->img);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
            $target->img = null;
        }
        return $target;
    }
}
