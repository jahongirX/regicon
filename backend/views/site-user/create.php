<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteUser */

$this->title = 'Create Site User';
$this->params['breadcrumbs'][] = ['label' => 'Site Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
