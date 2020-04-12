<?php

/* @var $this yii\web\View */
/* @var $model app\models\PjeRecipient */

$this->title = 'Create Recipient';
$this->params['breadcrumbs'][] = ['label' => 'Pje Recipients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-recipient-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
