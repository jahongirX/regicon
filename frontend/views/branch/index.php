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
                    <a class="kt-subheader__breadcrumbs-link"> Mening filiallarim </a>
                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>
    <!-- end:: Subheader -->

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="row">

            <?php if(Yii::$app->session->hasFlash('add-branch-success')): ?>

                <div class="alert alert-success">
                    <?php echo Yii::$app->session->getFlash('add-branch-success') ?>
                </div>

            <?php endif; ?>

            <div class="col-md-12 mb-3">
                <a href="<?=\yii\helpers\Url::to(['branch/add'])?>" class="btn btn-info">Yangi filial qo'shish</a>
            </div>

            <div class="col-md-12">

                <div class="card card-body text-center">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                'layout' => '{items}',
                'tableOptions' => [
                    'class' => 'table table-hover table-striped table-bordered gridview-table'
                ],
                'columns' => [


                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'v-align-middle'],
                    ],

                    [
                        'attribute' => 'username',
                        'contentOptions' => ['class' => 'v-align-middle'],
                    ],

                    [
                        'attribute' => 'phone',
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