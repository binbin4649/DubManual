<?php
$jump_counter = 0; //ページ内リンク(ジャンプ)のカウンター
?>
<h3 class="fs-6 text-secondary border-bottom mb-3 mb-md-4"><?= $topic->name ?></h3>
<?php foreach ($topic->dub_man_articles as $article): ?>
  <?php $jump_counter++; ?>
  <?php if ($article->img): ?>
    <section class="mb-5 mx-3">
      <div class="row mb-3">
        <div class="col-md-5 text-center mb-3">
          <img src="<?= $article->img ?>" alt="<?= $article->name ?>" class="rounded img-thumbnail img-fluid w-75 w-md-100">
        </div>
        <div class="col-md-7 mb-3">
          <p>
            <a href="#jump-<?= $jump_counter ?>" id="jump-<?= $jump_counter ?>" class="jump-view me-2">i</a>
            <?= nl2br($article->article) ?>
          </p>
        </div>
      </div>
    </section>
  <?php else: ?>
    <section class="mb-5 mx-3">
      <p class="small">
        <a href="#jump-<?= $jump_counter ?>" id="jump-<?= $jump_counter ?>" class="jump-view me-2">i</a>
        <?= nl2br($article->article) ?>
      </p>
    </section>
  <?php endif; ?>
<?php endforeach; ?>
<section class="mb-5 mx-3 text-center">
  <p>
    <a href="<?= $this->Url->build(['controller' => 'DubMan', 'action' => 'index']) ?>" class="btn btn-primary">使い方・操作方法 一覧に戻る</a>
  </p>
</section>