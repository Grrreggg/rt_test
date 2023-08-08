<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Queue statuses</h1>
<ul>
    <li>
        id s_name c_name a_type
    </li>
<?php foreach ($statuses as $status): ?>
    <li>
        <?= Html::encode("{$status->id} {$status->s_name} {$status->c_name} {$status->a_type}") ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>