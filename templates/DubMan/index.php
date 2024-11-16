<?php
$jump_counter = 0; //ページ内リンク(ジャンプ)のカウンター
?>
<h3 class="fs-6 text-secondary border-bottom mb-3 mb-md-4">使い方・操作方法</h3>
<?php foreach ($categories as $category): ?>
  <?php $jump_counter++; ?>
  <section class="mb-5 mx-3">
    <h4 class="fs-6 border-bottom mb-3 mb-md-4" id="jump-<?= $jump_counter ?>">
      <a href="#jump-<?= $jump_counter ?>" class="jump-index"><?= $category->name ?></a>
    </h4>
    <?php if (!empty($category->article)): ?>
      <p class="small"><?= nl2br($category->article) ?></p>
    <?php endif; ?>
    <ol>
      <?php foreach ($category->dub_man_topics as $topic): ?>
        <li class="ps-1"><a href="/dub-manual/dub-man/view/<?= $topic->id ?>"><?= $topic->name ?></a></li>
      <?php endforeach; ?>
    </ol>
  </section>
<?php endforeach; ?>