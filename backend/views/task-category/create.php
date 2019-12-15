<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaskCategory */

$this->title = 'Create Task Category';
$this->params['breadcrumbs'][] = ['label' => 'Task Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
