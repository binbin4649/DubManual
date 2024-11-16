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

/**
 * @var \BaserCore\View\BcAdminAppView $this
 * @var \Cake\Datasource\EntityInterface $dubManArticle
 */
$this->BcAdmin->setTitle(__d('baser_core', 'DubManArticle 新規登録'));
//$this->BcAdmin->setHelp('dubManArticles_form');
?>


<?= $this->BcAdminForm->create($dubManArticle, ['novalidate' => true, 'type' => 'file']) ?>

<?= $this->BcFormTable->dispatchBefore() ?>

<table class="bca-form-table">
  <tr>
    <th class="bca-form-table__label">
      Category<br>
      Topic
    </th>
    <td class="bca-form-table__input">
      <?= $topic->dub_man_category->name ?><br>
      <?= $topic->name ?>
      <?= $this->BcAdminForm->control('topic_id', ['type' => 'hidden', 'value' => $topic->id]) ?>
    </td>
  </tr>
  <tr>
    <th class="bca-form-table__label">
      <?= $this->BcAdminForm->label('name', __d('baser_core', 'Name')) ?>
    </th>
    <td class="bca-form-table__input">
      <?= $this->BcAdminForm->control('name', ['size' => 60]) ?>
      <?= $this->BcAdminForm->error('name') ?>
    </td>
  </tr>
  <tr>
    <th class="bca-form-table__label">
      <?= $this->BcAdminForm->label('article', __d('baser_core', 'Article')) ?>
    </th>
    <td class="bca-form-table__input">
      <?= $this->BcAdminForm->control('article') ?>
      <?= $this->BcAdminForm->error('article') ?>
    </td>
  </tr>
  <tr>
    <th class="bca-form-table__label">
      <?= $this->BcAdminForm->label('img', __d('baser_core', 'Img')) ?>
    </th>
    <td class="bca-form-table__input">
      <?= $this->BcAdminForm->control('img', ['type' => 'file']) ?>
      <?= $this->BcAdminForm->error('img') ?>
    </td>
  </tr>
  <tr>
    <th class="bca-form-table__label">
      <?= $this->BcAdminForm->label('sort_order', __d('baser_core', 'Sort Order')) ?>
    </th>
    <td class="bca-form-table__input">
      <?= $this->BcAdminForm->control('sort_order') ?>
      <?= $this->BcAdminForm->error('sort_order') ?>
    </td>
  </tr>
  <?= $this->BcAdminForm->dispatchAfterForm() ?>
</table>

<?= $this->BcFormTable->dispatchAfter() ?>

<div class="submit bca-actions">
  <div class="bca-actions__before">
    <?= $this->BcHtml->link(__d('baser_core', '一覧に戻る'), ['controller' => 'DubManTopics', 'action' => 'index', $topic->id], [
      'class' => 'bca-btn bca-actions__item',
      'data-bca-btn-type' => 'back-to-list'
    ]) ?>
  </div>
  <div class="bca-actions__main">
    <?= $this->BcAdminForm->submit(__d('baser_core', '保存'), [
      'div' => false,
      'class' => 'bca-btn bca-actions__item bca-loading',
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
      'id' => 'BtnSave'
    ]) ?>
  </div>
</div>

<?= $this->BcAdminForm->end() ?>
