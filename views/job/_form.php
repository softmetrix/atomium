<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PjeJob */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

        <?= $form->field($model, 'job_class')->dropDownList(\app\models\PjeJob::jobClasses()); ?>

        <?= $form->field($model, 'parallel')->checkbox(); ?>

        <?= $form->field($model, 'lock')->checkbox()->hint('Prevent simultaneous calls'); ?>

        <?= $form->field($model, 'rollback_job_id')->dropDownList(\app\models\PjeJob::rollbackJobs()); ?>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>  
    </div>
    <?php ActiveForm::end(); ?> 
</div>


