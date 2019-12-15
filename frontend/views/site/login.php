<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Kirish';
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
                            <a class="nav-link active" data-toggle="tab" href="#kt_tabs_7_1" role="tab"><i class="la la-cloud-upload"></i> Tizimga kirish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=\yii\helpers\Url::to(['site/register'])?>" ><i class="la la-puzzle-piece"></i> Ro'yxatdan o'tish</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_tabs_7_1" role="tabpanel">
                            <h1><?= Html::encode($this->title) ?></h1>

                            <p>Tizimga kirish uchun iltimos quyidagi ma'lumotlarni to'ldiring!</p>
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',

                            ]); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <div class="form-group">
                                <?= Html::submitButton('Kirish', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                        <div class="tab-pane" id="kt_tabs_7_3" role="tabpanel">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </div>
                    </div>

                </div>
            </div>
            <!--end::Portlet-->

        </div>

    </div>
</div>

</div>
