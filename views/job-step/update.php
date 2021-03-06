<?php

/* @var $this yii\web\View */
/* @var $model app\models\PjeJobStep */

$this->title = 'Update Job Step: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => '/job/index'];
$this->params['breadcrumbs'][] = ['label' => $model->job->title, 'url' => '/job/'.$model->job_id];
$this->params['breadcrumbs'][] = ['label' => 'Job Steps', 'url' => '/job-step/index/'.$model->job_id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-job-step-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
