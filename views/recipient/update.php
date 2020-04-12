<?php

/* @var $this yii\web\View */
/* @var $model app\models\PjeRecipient */

$this->title = 'Update Recipient';
$this->params['breadcrumbs'][] = ['label' => 'Pje Recipients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pje-recipient-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>
</div>
