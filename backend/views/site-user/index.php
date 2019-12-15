<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SiteUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Site User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'creator',
            //'company_id',
            //'district_id',
            //'rank',
            //'fio',
            //'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
