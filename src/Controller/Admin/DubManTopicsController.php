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
 * DubManTopics Controller
 *
 * @property \DubManual\Model\Table\DubManTopicsTable $DubManTopics
 */
class DubManTopicsController extends BcAdminAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index(\DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service)
    // {
    // 	$this->set($service->getViewVarsForIndex(
    // 		$this->paginate($service->getIndex())
    // 	));
    // }

    /**
     * View method
     *
     * @param \DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service
     * @param string|null $id Dub Man Topic id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(\DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service, int $id = null)
    {
        $this->set($service->getViewVarsForView($service->get((int) $id)));
    }

    /**
     * Add method
     *
     * @param \DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service
     * @param string|null $categoryId
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(\DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service, $categoryId = null)
    {
        if ($this->request->is('post', 'patch', 'put')) {
            // EVENT DubManTopics.beforeAdd
            $event = $this->dispatchLayerEvent('beforeAdd', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }

            try {
                $entity = $service->create($this->getRequest()->getData());

                // EVENT DubManTopics.afterAdd
                $this->dispatchLayerEvent('afterAdd', [
                    'data' => $entity
                ]);

                $this->BcMessage->setSuccess(__d('baser_core', "DubManTopics「{0}」を登録しました。", $entity->name));
                // return $this->redirect(['action' => 'edit', $entity->id]);
                return $this->redirect(['controller' => 'DubManCategories', 'action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $entity = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }
        $category = $service->getCategoryById($categoryId);
        $this->set('category', $category);
        $this->set($service->getViewVarsForAdd($entity ?? $service->getNew($categoryId)));
    }

    /**
     * Edit method
     *
     * @param \DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service
     * @param string|null $id Dub Man Topic id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(\DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service, $id = null)
    {
        $entity = $service->get((int) $id, [
            'contain' => ['DubManCategories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // EVENT DubManTopics.beforeEdit
            $event = $this->dispatchLayerEvent('beforeEdit', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }

            try {
                $entity = $service->update($entity, $this->request->getData());

                // EVENT DubManTopics.afterEdit
                $this->dispatchLayerEvent('afterEdit', [
                    'data' => $entity
                ]);

                $this->BcMessage->setSuccess(__d('baser_core', "DubManTopics「{0}」を更新しました。", $entity->name));
                // return $this->redirect(['action' => 'edit', $id]);
                return $this->redirect(['controller' => 'DubManCategories', 'action' => 'index']);
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
     * @param \DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service
     * @param string|null $id Dub Man Topic id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(\DubManual\Service\Admin\DubManTopicsAdminServiceInterface $service, $id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        try {
            $entity = $service->get((int) $id);
            if ($service->delete((int) $id)) {
                $this->BcMessage->setSuccess(__d(
                    'baser_core',
                    'エントリー「{0}」を削除しました。',
                    $entity->name
                ));
            }
        } catch (\Throwable $e) {
            $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。') . $e->getMessage());
        }
        return $this->redirect(['controller' => 'DubManCategories', 'action' => 'index']);
    }
}
