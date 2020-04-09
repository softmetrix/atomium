<?php

use yii\widgets\Pjax;

$this->beginBlock('content-header'); ?>
Dashboard
<?php $this->endBlock(); ?>
<?=
$this->render('_filter', [
    'jobs' => $jobs,
    'selectedJob' => $selectedJob,
]);
?>
<?php Pjax::begin(['id' => 'pjax-job-stats']); ?>
<?=
    $this->render('_widgets', [
        'completedCount' => $completedCount,
        'failedCount' => $failedCount,
        'avgDuration' => $avgDuration,
        'maxDuration' => $maxDuration,
    ]);
?>
<div class="row">
    <div class="col-md-6">
       <?=
        $this->render('_last_execution', ['dataProvider' => $lastExecutionsProvider]);
       ?>
    </div>
     <div class="col-md-6">
       <?=
        $this->render('_failed_execution', ['dataProvider' => $failedExecutionsProvider]);
       ?>
    </div>
</div>
<?php Pjax::end(); ?>

<?php
$js = <<<EOT
    $(function(){
        function refreshJobData() {
            $.pjax.reload({container: '#pjax-job-stats'});
        }
        setInterval(refreshJobData, 20000);
    });
EOT;
$this->registerJs($js);
?>
