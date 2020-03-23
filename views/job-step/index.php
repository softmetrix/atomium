<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PjeJobStepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job steps';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => '/job/index'];
$this->params['breadcrumbs'][] = ['label' => $job->title, 'url' => '/job/'.$job->id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-job-step-index">
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
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'title',
                         [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {params} {up} {down} {delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-default">Update &nbsp;<i class="glyphicon glyphicon-pencil"></i></button>', $url);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-danger">Delete &nbsp;<i class="glyphicon glyphicon-trash"></i></button>', $url,
                                            ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST']
                                        );
                                },
                                'params' => function ($url, $model) {
                                    $url = '/job-step-param/index/'.$model->id;

                                    return Html::a(
                                        '<button class="btn btn-default">Params &nbsp;<i class="glyphicon glyphicon-list"></i></button>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Params'),
                                    ]
                                    );
                                },
                                'up' => function ($url, $model) {
                                    $url = '/job-step/move-up/'.$model->id;

                                    return Html::a(
                                        '<button class="btn btn-default">Move up &nbsp;<i class="glyphicon glyphicon-arrow-up"></i></button>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Move up'),
                                    ]
                                    );
                                },
                                'down' => function ($url, $model) {
                                    $url = '/job-step/move-down/'.$model->id;

                                    return Html::a(
                                        '<button class="btn btn-default">Move down &nbsp;<i class="glyphicon glyphicon-arrow-down"></i></button>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Move down'),
                                    ]
                                    );
                                },
                            ],
                        ],
                    ],
               ]); ?>
            </div>
              <div class="box-footer">
                  <?= Html::a('Add step to job', '/job-step/create/'.$jobId, ['class' => 'btn btn-success']); ?>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</div>
