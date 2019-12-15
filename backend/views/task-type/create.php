<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaskType */

$this->title = 'Create Task Type';
$this->params['breadcrumbs'][] = ['label' => 'Task Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
