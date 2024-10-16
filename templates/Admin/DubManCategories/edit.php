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
 * @var \Cake\Datasource\EntityInterface $dubManCategory
 */
$this->BcAdmin->setTitle(__d('baser_core', 'DubManCategory 編集'));
$this->BcAdmin->addAdminMainBodyHeaderLinks([
  'url' => ['action' => 'add'],
  'title' => __d('baser_core', '新規登録'),
]);
//$this->BcAdmin->setHelp('dubManCategories_form');
?>


<?= $this->BcAdminForm->create($dubManCategory, ['novalidate' => true]) ?>

<?= $this->BcFormTable->dispatchBefore() ?>

<table class="bca-form-table">
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
      <?= $this->BcAdminForm->label('sort_order', __d('baser_core', 'Sort Order')) ?>
    </th>
    <td class="bca-form-table__input">
      <?= $this->BcAdminForm->control('sort_order') ?>
      <?= $this->BcAdminForm->error('sort_order') ?>
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
      <?= $this->BcAdminForm->label('is_publish', __d('baser_core', 'Is Publish')) ?>
    </th>
    <td class="bca-form-table__input">
      <?= $this->BcAdminForm->control('is_publish') ?>
      <?= $this->BcAdminForm->error('is_publish') ?>
    </td>
  </tr>
  <?= $this->BcAdminForm->dispatchAfterForm() ?>
</table>

<?= $this->BcFormTable->dispatchAfter() ?>

<div class="submit bca-actions">
  <div class="bca-actions__before">
    <?= $this->BcHtml->link(__d('baser_core', '一覧に戻る'), ['action' => 'index'], [
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
  <div class="bca-actions__sub">
    <?= $this->BcAdminForm->postLink(
      __d('baser_core', '削除'),
      ['action' => 'delete', $dubManCategory->id],
      [
        'block' => true,
        'confirm' => __d('baser_core', '{0} を本当に削除してもいいですか？', $dubManCategory->name),
        'class' => 'bca-btn bca-actions__item',
        'data-bca-btn-type' => 'delete',
        'data-bca-btn-size' => 'sm',
        'data-bca-btn-color' => "danger"
      ]
    ) ?>
  </div>
</div>

<?= $this->BcAdminForm->end() ?>

<?= $this->fetch('postLink') ?>