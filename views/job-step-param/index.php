<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PjeStepParamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Params';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => '/job/index'];
$this->params['breadcrumbs'][] = ['label' => $jobStep->job->title, 'url' => '/job/'.$jobStep->job_id];
$this->params['breadcrumbs'][] = ['label' => 'Job Steps', 'url' => '/job-step/index/'.$jobStep->job_id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-job-step-param-index">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <?= GridView::widget([
                    'tableOptions' => [
                        'class' => 'table table-striped table-bordered dataTable',
                    ],
                    'options' => [
                        'class' => 'table-responsive',
                    ],
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'param_name',
                        'param_value',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-default">Update &nbsp;<i class="glyphicon glyphicon-pencil"></i></button>', $url);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-danger">Delete &nbsp;<i class="glyphicon glyphicon-trash"></i></button>', $url,
                                            ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST']
                                        );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
              <div class="box-footer">
                  <?= Html::a('Add param to step', '/job-step-param/create/'.$jobStepId, ['class' => 'btn btn-success']); ?>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    
</div>
