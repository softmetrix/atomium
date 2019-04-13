<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PjeStep;

/* @var $this yii\web\View */
/* @var $model app\models\PjeJobStep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'step_id')->dropDownList(
            ArrayHelper::map(PjeStep::find()->where(['is_active' => PjeStep::ACTIVE])->all(), 'id', 'title')
        ) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'stop_on_failure')->checkbox() ?>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?> 
</div>