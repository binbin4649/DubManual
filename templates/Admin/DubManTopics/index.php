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
 * @var iterable<\Cake\Datasource\EntityInterface> $dubManTopics
 */
$this->BcAdmin->setTitle(__d('baser_core', $topic->name . ' Articles'));
$this->BcAdmin->addAdminMainBodyHeaderLinks([
  'url' => ['action' => 'add'],
  'title' => __d('baser_core', '新規登録'),
]);
//$this->BcAdmin->setHelp('dubManTopics_form');

?>
<div class="bca-section">
  <div class="bca-panel-box" id="FunctionBox">
    <?= $this->BcHtml->link('Article追加', [
      'controller' => 'DubManArticles',
      'action' => 'add',
      $topic->id,
    ], [
      'class' => ' bca-btn',
      'data-bca-btn-type' => 'add',
      'data-bca-btn-size' => 'lg'
    ]) ?>
    <?= $this->BcHtml->link(
      '仕様確認',
      'https://docs.google.com/spreadsheets/d/1vlJjsQzbmu2mF3ddp36Qardt_Of3FDUXpItf9vRhw6k/edit?pli=1&gid=1020770683#gid=1020770683',
      [
        'class' => ' bca-btn bca-icon--alias',
        'data-bca-btn-type' => 'view',
        'data-bca-btn-size' => 'lg',
        'target' => '_blank'
      ]
    ) ?>
    <?= $this->BcHtml->link('サイト確認', [
      'plugin' => 'DubManual',
      'controller' => 'DubMan',
      'action' => 'view',
      $topic->id,
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
        <th class="bca-table-listup__thead-th" style="width:3%">Id</th>
        <th class="bca-table-listup__thead-th" style="width:3%">Img</th>
        <th class="bca-table-listup__thead-th" style="width:3%">順</th>
        <th class="bca-table-listup__thead-th">Article</th>
        <th class="bca-table-listup__thead-th">Action</th>
      </tr>
    </thead>
    <tbody class="bca-table-listup__tbody">
      <?php if ($topic): ?>
        <?php foreach ($topic->dub_man_articles as $key => $article): ?>
          <tr>
            <td class="bca-table-listup__tbody-td"><?= $article->id ?></td>
            <td class="bca-table-listup__tbody-td">
              <?php if ($article->img): ?>
                <i class="bca-icon--file"></i>
              <?php endif; ?>
            </td>
            <td class="bca-table-listup__tbody-td"><?= $this->Number->format($article->sort_order) ?></td>
            <td class="bca-table-listup__tbody-td"><?= $article->article_display ?></td>
            <td class="bca-table-listup__tbody-td bca-table-listup__tbody-td--actions" style="width:15%">
              <?= $this->BcHtml->link('', ['controller' => 'DubManArticles', 'action' => 'edit', $article->id], [
                'title' => __d('baser_core', 'アーティクル編集'),
                'class' => ' bca-btn-icon',
                'data-bca-btn-type' => 'edit',
                'data-bca-btn-size' => 'lg'
              ]) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="bca-table-listup__tbody-td">
            <p class="no-data"><?= __d('baser_core', 'データが見つかりませんでした。') ?></p>
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
