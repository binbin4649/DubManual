<?php
$this->BcAdmin->setTitle(__d('baser_core', 'bca-icon data-bca-btn-type 一覧'));

$icons = [
    'arrow-down',
    'minus-square',
    'arrow-left',
    'theme',
    'menuitem',
    'th-list',
    'copy',
    'back',
    'desc',
    'file',
    'folder',
    'chevron-down',
    'list-default',
    'permission',
    'unpublish',
    'open',
    'globe',
    'update',
    'preview',
    'plus-square',
    'mail',
    'search',
    'question-circle',
    'switch',
    'asc',
    'bookmark',
    'arrow-right',
    'home',
    'setting',
    'publish',
    'add',
    'alias',
    'delete',
    'alert',
    'datetimepicker-time',
    'draggable',
    'facebook',
    'favorite',
    'list',
    'list-circle',
    'plugin',
    'clear',
    'file-list',
    'error',
    'next',
    'download',
    'link',
    'edit',
    'up-directory',
    'datetimepicker-date',
    'tools',
    'twitter',
    'notification',
    'arrow-up',
    'textcopy',
    'help',
    'apply',
    'sites',
    'back-to-list',
    'rename'
];

?>
<div class="bca-data-list">
    <table class="bca-table-listup">
        <tbody class="bca-table-listup__tbody">
            <?php
            foreach ($icons as $icon) {
                echo '<tr>';
                echo '<td>' . $icon . '</td>';
                echo '</td>';
                echo '<td class="bca-table-listup__tbody-td">';
                echo '<i class="bca-icon--' . $icon . '"></i>';
                echo htmlspecialchars('<i class="bca-icon--' . $icon . '"></i>');
                echo '</td>';
                echo '<td class="bca-table-listup__tbody-td">';
                echo $this->BcHtml->link('', [], [
                    'title' => __d('baser_core', $icon),
                    'class' => ' bca-btn-icon',
                    'data-bca-btn-type' => $icon,
                    'data-bca-btn-size' => 'lg'
                ]);
                echo htmlspecialchars('<a href="#" title="' . $icon . '" class=" bca-btn-icon" data-bca-btn-type="' . $icon . '" data-bca-btn-size="lg">');
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>