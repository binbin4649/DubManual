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
 * @var iterable<\Cake\Datasource\EntityInterface> $categories
 */
$this->BcAdmin->setTitle(__d('baser_core', 'DubManual'));
$this->BcAdmin->addAdminMainBodyHeaderLinks([
  'url' => ['action' => 'add'],
  'title' => __d('baser_core', '新規登録'),
]);
// $this->BcListTable->setColumnNumber(7);
//$this->BcAdmin->setHelp('dubManCategories_form');
//$this->BcAdmin->setSearch('dubManCategories_index');
?>

<div class="bca-section">
  <div class="bca-panel-box" id="FunctionBox">
    <?= $this->BcHtml->link('Category追加', [
      'action' => 'add',
    ], [
      'class' => ' bca-btn',
      'data-bca-btn-type' => 'add',
      'data-bca-btn-size' => 'lg'
    ]) ?>
    <?= $this->BcHtml->link('サイト確認', [
      'plugin' => 'DubManual',
      'controller' => 'DubMan',
      'action' => 'index',
      'prefix' => false
    ], [
      'class' => ' bca-btn bca-icon--alias',
      'data-bca-btn-type' => 'view',
      'data-bca-btn-size' => 'lg',
      'target' => '_blank'
    ]) ?>
  </div>
</div>

<div class="bca-data-list">
  <table class="bca-table-listup">
    <thead class="bca-table-listup__thead">
      <tr>
        <th class="bca-table-listup__thead-th" style="width:3%">Type</th>
        <th class="bca-table-listup__thead-th" style="width:3%">順</th>
        <th class="bca-table-listup__thead-th" style="width:3%"></th>
        <th class="bca-table-listup__thead-th" style="width:3%"></th>
        <th class="bca-table-listup__thead-th">Name</th>
        <th class="bca-table-listup__thead-th">Action</th>
      </tr>
    </thead>
    <tbody class="bca-table-listup__tbody">
      <?php if (!$isEmpty): ?>
        <?php foreach ($categories as $key => $dubManCategory): ?>
          <tr <?php if (!$dubManCategory->is_publish): ?>style="background-color: #f0f0f0;" <?php endif; ?>>
            <td class="bca-table-listup__tbody-td"><i class="bca-icon--folder"></i></td>
            <td class="bca-table-listup__tbody-td"><?= $this->Number->format($dubManCategory->sort_order) ?></td>
            <td colspan="3" class="bca-table-listup__tbody-td"><?= h($dubManCategory->name) ?></td>
            <td class="bca-table-listup__tbody-td bca-table-listup__tbody-td--actions" style="width:15%">
              <?= $this->BcHtml->link('', ['controller' => 'DubManTopics', 'action' => 'add', $dubManCategory->id], [
                'title' => __d('baser_core', 'トピック追加'),
                'class' => ' bca-btn-icon',
                'data-bca-btn-type' => 'add',
                'data-bca-btn-size' => 'lg'
              ]) ?>
              <?= $this->BcHtml->link('', ['action' => 'edit', $dubManCategory->id], [
                'title' => __d('baser_core', '編集'),
                'class' => ' bca-btn-icon',
                'data-bca-btn-type' => 'edit',
                'data-bca-btn-size' => 'lg'
              ]) ?>
            </td>
          </tr>
          <?php foreach ($dubManCategory->dub_man_topics as $dubManTopic): ?>
            <tr <?php if (!$dubManTopic->is_publish): ?>style="background-color: #f0f0f0;" <?php endif; ?>>
              <td></td>
              <td class="bca-table-listup__tbody-td"><i class="bca-icon--file"></i></td>
              <td class="bca-table-listup__tbody-td"><?= $this->Number->format($dubManTopic->sort_order) ?></td>
              <td colspan="2" class="bca-table-listup__tbody-td">
                <a href="<?= $this->Url->build(['controller' => 'DubManTopics', 'action' => 'index', $dubManTopic->id]) ?>" target="_blank">
                  <?= h($dubManTopic->name) ?><i class="bca-icon--alias"></i>
                </a>
              </td>
              <td class="bca-table-listup__tbody-td bca-table-listup__tbody-td--actions" style="width:15%">
                <?= $this->BcHtml->link('', ['controller' => 'DubManTopics', 'action' => 'edit', $dubManTopic->id], [
                  'title' => __d('baser_core', 'トピック編集'),
                  'class' => ' bca-btn-icon',
                  'data-bca-btn-type' => 'edit',
                  'data-bca-btn-size' => 'lg'
                ]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="6" class="bca-table-listup__tbody-td">
            <p class="no-data"><?= __d('baser_core', 'データがありません。') ?></p>
          </td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
