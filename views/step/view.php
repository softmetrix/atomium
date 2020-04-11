<?php

/* @var $this yii\web\View */
/* @var $model app\models\PjeStep */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-step-view">


    <textarea readonly style="width: 100%; height: 500px;">
        <?= $code; ?>
    </textarea> 
</div>
