<?php

use yii\bootstrap\ActiveForm;
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
                    <a href="<?=\yii\helpers\Url::to(['branch/index'])?>" class="kt-subheader__breadcrumbs-home">Mening filiallarim</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a class="kt-subheader__breadcrumbs-link"> Yangi filial qo'shish </a>
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

                    <?php $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => true,
                    ]); ?>

                    <?php if($user->rank == 0): ?>

                        <?= $form->field($model, 'creator')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Company::find()->all(),'id','name')) ?>

                        <?= $form->field($model, 'rank')->dropDownList(Yii::$app->params['user_ranks']) ?>

                    <?php endif; ?>

                    <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\District::find()->where(['parent'=>8])->all(),'id','name')) ?>

                    <?= $form->field($model, 'email')->textInput(['options'=>['type'=>'email']]) ?>

                    <?= $form->field($model, 'username')->textInput() ?>

                    <?= $form->field($model, 'password_hash')->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>

        </div>

    </div>

</div>