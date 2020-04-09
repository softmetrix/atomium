<?php
use yii\grid\GridView;

?>
<div class="box box-info">
<div class="box-header">
  <h3 class="box-title">Next executions</h3>
</div>
<!-- /.box-header -->
<div class="box-body no-padding">    
    <?= GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Job',
                'value' => 'job',
            ],
            [
                'header' => 'Next Execution',
                'value' => 'next_execution',
            ],
        ],
        ]);
    ?>  
</div>
<!-- /.box-body -->
</div>