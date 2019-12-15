<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="<?=\yii\helpers\Url::to(['/'])?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i> Asosiy sahifa</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a class="kt-subheader__breadcrumbs-link"> Barcha topshiriqlar </a>
                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>
    <!-- end:: Subheader -->

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="card card-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'layout' => '{items}',
                        'tableOptions' => [
                            'class' => 'table table-hover table-striped table-bordered gridview-table text-center'
                        ],
                        'columns' => [

                            [
                                'class' => 'yii\grid\SerialColumn',
                                'contentOptions' => ['class' => 'v-align-middle'],
                            ],

                            [
                                'attribute' => 'registration_id',
                                'contentOptions' => ['class' => 'v-align-middle'],
                                'format' => 'html',
                                'value' => function($data){
                                    return "<a href='". \yii\helpers\Url::to(['task/view','id'=>$data->id]) ."'>" . $data->registration_id . "</a>";
                                }
                            ],

                            [
                                'attribute' => 'district_id',
                                'contentOptions' => ['class' => 'v-align-middle'],
                                'value' => function($data){
                                    $user = \common\models\SiteUser::findOne($data->user_id);
                                    return \common\models\District::findOne($user->district_id)->name;
                                }
                            ],

                            [
                                'attribute' => 'created_date',
                                'contentOptions' => ['class' => 'v-align-middle'],
                            ],
                            [
                                'attribute' => 'deadline',
                                'contentOptions' => ['class' => 'v-align-middle'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Amallar',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'template' => '{buttons}',
                                'contentOptions' => ['style' => '', 'class' => 'v-align-middle'],
                                'buttons' => [
                                    'buttons' => function ($url, $model) {
                                        $controller = Yii::$app->controller->id;
                                        $code = <<<BUTTONS
	                                                <div class="btn-group flex-center">
                                                        <a href="/{$controller}/view/{$model->id}" class="btn btn-secondary"><i class="flaticon2-trash"></i></a>
	                                                    <a href="/{$controller}/update/{$model->id}" class="btn btn-primary"><i class="flaticon-edit"></i></a>
	                                                </div>
BUTTONS;
                                        return $code;
                                    }

                                ],
                            ],


                        ],

                    ]); ?>

                </div>

            </div>

        </div>

    </div>

</div>