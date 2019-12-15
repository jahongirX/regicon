<?php

use yii\grid\GridView;

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
                    <a class="kt-subheader__breadcrumbs-link"> Barcha topshiriqlar</a>
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
                                    return "<a href='". \yii\helpers\Url::to(['my/view','id'=>$data->id]) ."'>" . $data->registration_id . "</a>";
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
                                'attribute' => 'status',
                                'contentOptions' => ['class' => 'v-align-middle'],
                                'format' => 'html',
                                'value' => function($data){

                                    $value = '';
                                    switch ($data->status){

                                        case 0:
                                            $value = "<span class='badge badge-warning'>" . Yii::$app->params['admission_status'][$data->status] ."</span>";
                                            break;

                                        case 2:
                                            $value = "<span class='badge badge-primary'>" . Yii::$app->params['admission_status'][$data->status] ."</span>";
                                            break;

                                        case 3:
                                            $value = "<span class='badge badge-danger'>" . Yii::$app->params['admission_status'][$data->status] ."</span>";
                                            break;
                                        case 4:
                                            $value = "<span class='badge badge-info'>" . Yii::$app->params['admission_status'][$data->status] ."</span>";
                                            break;
                                        case 5:
                                            $value = "<span class='badge badge-success'>" . Yii::$app->params['admission_status'][$data->status] ."</span>";
                                            break;
                                        case 7:
                                            $value = "<span class='badge badge-info'>" . Yii::$app->params['admission_status'][$data->status] ."</span>";
                                            break;
                                        default:
                                            $value = "<span class='badge badge-dark'>Хатолик!!!</span>";
                                            break;
                                    }

                                    return $value;

                                }
                            ],

                            [
                                'attribute' => 'daysLeft',
                                'contentOptions' => ['class' => 'v-align-middle'],
                                'format' => 'html',
                                'value' => function($data){

                                    $days = \common\models\Task::daysToDeadline($data->id);
                                    if($data->status < 6){
                                        if($days > 0){
                                            return "<span class='btn btn-success'>". $days ."</span>";
                                        }else if($days == 0){
                                            return "<span class='btn btn-warning'>Бугун</span>";
                                        }else{
                                            return "<span class='btn btn-danger'>". $days ."</span>";
                                        }
                                    }else{
                                        return "<span class='btn btn-success'><i class='fa fa-check'></i></span>";
                                    }

                                }
                            ],

                            [
                                'attribute' => 'deadline_status',
                                'contentOptions' => ['class' => 'v-align-middle'],
                                'format' => 'html',
                                'value' => function($data){
                                    if(!$data->deadline_status){
                                        return "<span class='badge badge-success'>Buzilmagan</span>";
                                    }else{
                                        return "<span class='badge badge-danger'>Buzildi</span>";
                                    }
                                }
                            ],

                        ],

                    ]); ?>

                </div>

            </div>

        </div>

    </div>

</div>