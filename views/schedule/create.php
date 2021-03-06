<?php

/* @var $this yii\web\View */
/* @var $model app\models\PjeSchedule */

$this->title = 'Create Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => '/job/index'];
$this->params['breadcrumbs'][] = ['label' => $model->job->title, 'url' => '/job/'.$model->job_id];
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => '/schedule/index/'.$model->job_id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-schedule-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
