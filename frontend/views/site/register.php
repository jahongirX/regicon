<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Ro'yxatdan o'tish";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <div class="site-login">

        <div class="row align-items-center">

            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-success" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="<?=\yii\helpers\Url::to(['site/login'])?>"><i class="la la-cloud-upload"></i> Tizimga kirish</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  ><i class="la la-puzzle-piece"></i> Ro'yxatdan o'tish</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active">



                                <?php if(!empty($usedIds) && !empty(\common\models\Company::find()->where(['not in','id',$usedIds])->all())): ?>

                                <h1><?= Html::encode($this->title) ?></h1>


                                <?php $form = ActiveForm::begin([
                                    'id' => 'register-form',
                                    'enableAjaxValidation' => true,
                                    'enableClientValidation' => true,
                                ]); ?>

                                <?= $form->field($model, 'company_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Company::find()->where(['not in','id',$usedIds])->all(),'id','name')) ?>

                                <?= $form->field($model, 'email')->textInput(['options'=>['type'=>'email']]) ?>

                                <?= $form->field($model, 'username')->textInput() ?>

                                <?= $form->field($model, 'password')->passwordInput() ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>

                                <?php else: ?>

                                    <div class="alert alert-warning">

                                        Ro'yxatdan o'tish to'xtatilgan

                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Portlet-->

            </div>

        </div>
    </div>

</div>
