<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PjeRecipient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'notify_on_success')->checkbox(); ?>
        <?= $form->field($model, 'notify_on_failure')->checkbox(); ?>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>  
    </div>
    <?php ActiveForm::end(); ?> 
</div>
