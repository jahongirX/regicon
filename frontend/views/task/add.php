<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
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
                    <a class="kt-subheader__breadcrumbs-link"> Yangi topshiriq yaratish </a>
                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>
    <!-- end:: Subheader -->

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="card card-body">
<!--            --><?php //print_r($branches) ?>
            <?php if(!empty($branches)): ?>

                    <?php $form = ActiveForm::begin([
                        'id' => 'task-create',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => true,
                    ]); ?>

            <div class="row">

                    <div class="col-md-12">

                        <?= $form->field($model, 'user_id')->dropDownList(\common\models\Task::getHierarchy(),['multiple'=>'multiple', 'options'=>[],'required'=>'required']) ?>

                    </div>

                    <div class="col-md-12">

                        <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TaskCategory::find()->all(),'id','name')) ?>

                    </div>

                    <div class="col-md-12">

                        <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TaskType::find()->all(),'id','name')) ?>

                    </div>

                    <div class="col-md-12">

                        <?= $form->field($model, 'description')->textarea(['rows'=>5]) ?>

                    </div>

                    <div class="col-md-12">

                        <?php echo $form->field($model, 'deadline')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Muddatni belgilang','autocomplete'=>'off'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd-m-yyyy'
                            ]
                        ]);?>

                    </div>

                    <div class="col-md-12">

                    <?= $form->field($model, 'file')->widget(FileInput::class, [
                        'showMessage' => false,
                        'language' => 'uz',
                        'pluginOptions' => [
                            'showCaption' => true ,
                            'showRemove' => true ,
                            'showUpload' => false ,
                            'showPreview' => true ,
                            'browseClass' => 'btn btn-primary',
                            'browseIcon' => '<i style="color:white" class="flaticon2-file"></i> ' ,
                            'allowedFileExtensions'=>['pdf','doc','docx','zip','jpg','png','jpeg','xls','xlsx'],
                        ] ,
                        'options' => ['multiple'=>false,'required'=>true] ,
                    ]) ?>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">
                            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>

            <?php else: ?>
                <div class="alert alert-warning">
                    Topshiriq yuborish uchun sizda Filial tashkiloti qo'shilmagan, dastavval filial qo'shing!
                </div>
                <div>
                    <a href="<?=\yii\helpers\Url::to(['branch/add'])?>" class="btn btn-info">Filial qo'shish</a>
                </div>
            <?php endif; ?>

        </div>

    </div>

</div>

