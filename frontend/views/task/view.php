<?php

use yii\widgets\DetailView;

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
                    <a href="<?=\yii\helpers\Url::to(['task/index'])?>" class="kt-subheader__breadcrumbs-home">Barcha topshiriqlar</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a class="kt-subheader__breadcrumbs-link"> <?=$model->registration_id?> </a>
                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>
    <!-- end:: Subheader -->

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="card card-body">
            <h3>Asosiy ma'lumotlar</h3>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'registration_id',
                    [
                        'attribute' => 'category_id',
                        'contentOptions' => ['class' => 'v-align-middle'],
                        'value' => function($data){
                            return \common\models\TaskCategory::findOne($data->category_id)->name;
                        }
                    ],
                    [
                        'attribute' => 'type_id',
                        'contentOptions' => ['class' => 'v-align-middle'],
                        'value' => function($data){
                            return \common\models\TaskType::findOne($data->type_id)->name;
                        }
                    ],
                    [
                        'attribute' => 'user_id',
                        'contentOptions' => ['class' => 'v-align-middle'],
                        'value' => function($data){
                            $user = \common\models\SiteUser::findOne($data->user_id);
                            return \common\models\District::findOne($user->district_id)->name;
                        }
                    ],
                    'description:ntext',
                    [
                        'attribute' => 'file',
                        'contentOptions' => ['class' => 'v-align-middle'],
                        'format' => 'html',
                        'value' => function($data){

                            if($data->file && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . 'task/' . $data->id . '/' . $data->file)) {

                                $file = Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . 'task/' . $data->id . '/' .  $data->file;

                            } else {

                                $file = 'No File!';

                            }

                            return "<a download href=\"". $file. "\">" .  $data->file ."</a>";

                        }
                    ],
                    'deadline',
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
                    'created_date',
                    'updated_date',
                    [
                        'attribute' => 'view_status',
                        'contentOptions' => ['class' => 'v-align-middle'],
                        'format' => 'html',
                        'value' => function($data){
                            if($data->view_status){
                                return "<span class='btn btn-success'>O'qildi</span>";
                            }else{
                                return "<span class='btn btn-warning'>Ochilmagan</span>";
                            }
                        }
                    ],
                    [
                        'attribute' => 'deadline_status',
                        'contentOptions' => ['class' => 'v-align-middle'],
                        'format' => 'html',
                        'value' => function($data){
                            if(!$data->deadline_status){
                                return "<span class='btn btn-success'>Buzilmagan</span>";
                            }else{
                                return "<span class='btn btn-danger'>Buzildi</span>";
                            }
                        }
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
                ],
            ]) ?>

        </div>

        <div class="card card-body mt-4">
            <h3>Filialdan javob</h3>

            <?php if(!empty($model->answer_file)): ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'answer_file',
                    'answer_description:ntext',
                ],
            ]) ?>

            <a href="<?=\yii\helpers\Url::to(['task/close','id'=>$model->id])?>" class="btn btn-success">Topshiriqni yopish</a>

            <?php else: ?>
                <div class="alert alert-warning">Filialdan javob kelmagan!</div>
            <?php endif; ?>
        </div>

    </div>

</div>

</div>

