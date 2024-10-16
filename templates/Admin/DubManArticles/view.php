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
?>

<table class="bca-form-table">
  <tr>
    <th class="bca-form-table__label"><?= __d('baser_core', 'Name') ?></th>
    <td class="bca-form-table__input"><?= h($dubManArticle->name) ?></td>
  </tr>
  <tr>
    <th class="bca-form-table__label"><?= __d('baser_core', 'Img') ?></th>
    <td class="bca-form-table__input"><?= h($dubManArticle->img) ?></td>
  </tr>
  <tr>
    <th class="bca-form-table__label"><?= __d('baser_core', 'Id') ?></th>
    <td class="bca-form-table__input"><?= $this->Number->format($dubManArticle->id) ?></td>
  </tr>
  <tr>
    <th class="bca-form-table__label"><?= __d('baser_core', 'Topic Id') ?></th>
    <td class="bca-form-table__input"><?= $this->Number->format($dubManArticle->topic_id) ?></td>
  </tr>
  <tr>
    <th class="bca-form-table__label"><?= __d('baser_core', 'Sort Order') ?></th>
    <td class="bca-form-table__input"><?= $this->Number->format($dubManArticle->sort_order) ?></td>
  </tr>
  <tr>
      <th class="bca-form-table__label"><?= __d('baser_core', 'Created') ?></th>
      <td class="bca-form-table__input"><?= h($dubManArticle->created) ?></td>
  </tr>
  <tr>
      <th class="bca-form-table__label"><?= __d('baser_core', 'Modified') ?></th>
      <td class="bca-form-table__input"><?= h($dubManArticle->modified) ?></td>
  </tr>
</table>

<div class="submit bca-actions">
  <div class="bca-actions__before">
    <?= $this->BcHtml->link(__d('baser_core', '一覧に戻る'), ['action' => 'index'], [
      'class' => 'bca-btn bca-actions__item',
      'data-bca-btn-type' => 'back-to-list'
    ]) ?>
    <?= $this->BcHtml->link(__d('baser_core', '新規登録'), ['action' => 'add'], [
      'class' => 'bca-btn bca-actions__item',
      'data-bca-btn-type' => 'add',
    ]) ?>
  </div>
  <div class="bca-actions__main">
    <?= $this->BcHtml->link(__d('baser_core', '編集'), ['action' => 'edit', $dubManArticle->id], [
      'class' => 'bca-btn bca-actions__item',
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
    ]) ?>
  </div>
  <div class="bca-actions__sub">
    <?= $this->BcAdminForm->postLink( __d('baser_core', '削除'), ['action' => 'delete', $dubManArticle->id], [
      'block' => true,
      'confirm' => __d('baser_core', '{0} を本当に削除してもいいですか？', $dubManArticle->name),
      'class' => 'bca-btn bca-actions__item',
      'data-bca-btn-type' => 'delete',
      'data-bca-btn-size' => 'sm',
      'data-bca-btn-color' => "danger"
      ]
    ) ?>
  </div>
</div>
