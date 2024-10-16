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
 * @var iterable<\Cake\Datasource\EntityInterface> $dubManArticles
 */
$this->BcAdmin->setTitle(__d('baser_core', 'Dub Man Articles 一覧'));
$this->BcAdmin->addAdminMainBodyHeaderLinks([
  'url' => ['action' => 'add'],
  'title' => __d('baser_core', '新規登録'),
]);
$this->BcListTable->setColumnNumber(8);
//$this->BcAdmin->setHelp('dubManArticles_form');
//$this->BcAdmin->setSearch('dubManArticles_index');
?>


<div class="bca-data-list">
  <div class="bca-data-list__top">
    <div class="bca-data-list__sub">
      <?php $this->BcBaser->element('pagination') ?>
    </div>
  </div>

  <table class="bca-table-listup">
    <thead class="bca-table-listup__thead">
    <tr>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('id', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Id'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Id')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('name', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Name'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Name')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('topic_id', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Topic Id'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Topic Id')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('img', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Img'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Img')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('sort_order', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Sort Order'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Sort Order')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('created', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Created'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Created')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th">
        <?= $this->Paginator->sort('modified', [
          'asc' => '<i class="bca-icon--asc"></i>' . __d('baser_core', 'Modified'),
          'desc' => '<i class="bca-icon--desc"></i>' . __d('baser_core', 'Modified')
          ], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']
        ) ?>
      </th>
      <th class="bca-table-listup__thead-th"><?= __d('baser_core', 'アクション') ?></th>
    </tr>
    </thead>
    <tbody class="bca-table-listup__tbody">
<?php if (!$dubManArticles->isEmpty()): ?>
  <?php foreach($dubManArticles as $key => $dubManArticle): ?>
      <tr id="Row<?= $key ?>">
        <td class="bca-table-listup__tbody-td"><?= $this->Number->format($dubManArticle->id) ?></td>
        <td class="bca-table-listup__tbody-td"><?= h($dubManArticle->name) ?></td>
        <td class="bca-table-listup__tbody-td"><?= $this->Number->format($dubManArticle->topic_id) ?></td>
        <td class="bca-table-listup__tbody-td"><?= h($dubManArticle->img) ?></td>
        <td class="bca-table-listup__tbody-td"><?= $this->Number->format($dubManArticle->sort_order) ?></td>
        <td class="bca-table-listup__tbody-td"><?= h($dubManArticle->created) ?></td>
        <td class="bca-table-listup__tbody-td"><?= h($dubManArticle->modified) ?></td>
        <td class="bca-table-listup__tbody-td bca-table-listup__tbody-td--actions" style="width:15%">
          <?php if (!empty($dubManArticle->status)) : ?>
            <!--<?= $this->BcAdminForm->postLink('', ['action' => 'unpublish', $dubManArticle->id], [
              'title' => __d('baser_core', '非公開'),
              'class' => 'btn-unpublish bca-btn-icon',
              'data-bca-btn-type' => 'unpublish',
              'data-bca-btn-size' => 'lg'
            ]) ?>-->
            <?= $this->BcHtml->link('', ['action' => 'view', $dubManArticle->id], [
              'title' => __d('baser_core', '確認'),
              'class' => 'bca-btn-icon',
              'data-bca-btn-type' => 'preview',
              'data-bca-btn-size' => 'lg'
            ]) ?>
          <?php else: ?>
            <!--<?= $this->BcAdminForm->postLink('', ['action' => 'publish', $dubManArticle->id], [
              'title' => __d('baser_core', '公開'),
              'class' => 'btn-publish bca-btn-icon',
              'data-bca-btn-type' => 'publish',
              'data-bca-btn-size' => 'lg'
            ]) ?>-->
          <?php endif ?>
          <?= $this->BcHtml->link('', ['action' => 'edit', $dubManArticle->id], [
              'title' => __d('baser_core', '編集'),
              'class' => ' bca-btn-icon',
              'data-bca-btn-type' => 'edit',
              'data-bca-btn-size' => 'lg'
          ]) ?>
        </td>
      </tr>
  <?php endforeach; ?>
<?php else: ?>
      <tr>
        <td colspan="<?= $this->BcListTable->getColumnNumber() ?>" class="bca-table-listup__tbody-td">
          <p class="no-data"><?= __d('baser_core', 'データがありません。') ?></p>
        </td>
      </tr>
<?php endif ?>
    </tbody>
  </table>
</div>