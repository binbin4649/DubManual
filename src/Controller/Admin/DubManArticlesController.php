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

namespace DubManual\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;

/**
 * DubManArticles Controller
 *
 * @property \DubManual\Model\Table\DubManArticlesTable $DubManArticles
 */
class DubManArticlesController extends BcAdminAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index(\DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service)
    // {
    // 	$this->set($service->getViewVarsForIndex(
    // 		$this->paginate($service->getIndex())
    // 	));
    // }

    /**
     * View method
     *
     * @param \DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service
     * @param string|null $id Dub Man Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(\DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service, int $id = null)
    {
        $this->set($service->getViewVarsForView($service->get((int) $id)));
    }

    /**
     * Add method
     *
     * @param \DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service
     * @param string|null $topicId
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(\DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service, $topicId = null)
    {
        if ($this->request->is('post', 'patch', 'put')) {
            // EVENT DubManArticles.beforeAdd
            $event = $this->dispatchLayerEvent('beforeAdd', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }
            try {
                $entity = $service->create($this->getRequest()->getData());
                // EVENT DubManArticles.afterAdd
                $this->dispatchLayerEvent('afterAdd', [
                    'data' => $entity
                ]);
                $this->BcMessage->setSuccess(__d('baser_core', "DubManArticles「{0}」を登録しました。", $entity->id));
                return $this->redirect(['controller' => 'DubManTopics', 'action' => 'index', $entity->topic_id]);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $entity = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }
        $topic = $service->getTopicById($topicId);
        $this->set('topic', $topic);
        $this->set($service->getViewVarsForAdd($entity ?? $service->getNew($topicId)));
    }

    /**
     * Edit method
     *
     * @param \DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service
     * @param string|null $id Dub Man Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(\DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service, $id = null)
    {
        $entity = $service->get((int) $id, [
            'contain' => ['DubManTopics.DubManCategories'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // EVENT DubManArticles.beforeEdit
            $event = $this->dispatchLayerEvent('beforeEdit', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }

            try {
                $entity = $service->update($entity, $this->request->getData());

                // EVENT DubManArticles.afterEdit
                $this->dispatchLayerEvent('afterEdit', [
                    'data' => $entity
                ]);

                $this->BcMessage->setSuccess(__d('baser_core', "DubManArticles「{0}」を更新しました。", $entity->id));
                return $this->redirect(['controller' => 'DubManTopics', 'action' => 'index', $entity->topic_id]);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $entity = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }

        $this->set($service->getViewVarsForEdit($entity));
    }

    /**
     * Delete method
     *
     * @param \DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service
     * @param string|null $id Dub Man Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(\DubManual\Service\Admin\DubManArticlesAdminServiceInterface $service, $id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $entity = $service->get((int) $id);
        try {
            if ($service->delete((int) $id)) {
                $this->BcMessage->setSuccess(__d(
                    'baser_core',
                    'エントリー「{0}」を削除しました。',
                    $entity->id
                ));
            }
        } catch (\Throwable $e) {
            $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。') . $e->getMessage());
        }
        return $this->redirect(['controller' => 'DubManTopics', 'action' => 'index', $entity->topic_id]);
    }
}
