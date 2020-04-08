<?php

/* @var $this yii\web\View */
/* @var $model app\models\PjeJobStepParam */

$this->title = 'Update Param';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => '/job/index'];
$this->params['breadcrumbs'][] = ['label' => $jobStep->job->title, 'url' => '/job/'.$jobStep->job_id];
$this->params['breadcrumbs'][] = ['label' => 'Job Steps', 'url' => '/job-step/index/'.$jobStep->job_id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-job-step-param-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
