<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PjeJobStepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job steps';
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
                            'template' => '{view} {update} {delete} {params} {up} {down}',
                            'buttons' => [
                                'params' => function ($url, $model) {
                                    $url = '/job-step-param/index/' . $model->id;
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-list"></span>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Params'),
                                    ]
                                    );
                                },
                                'up' => function ($url, $model) {
                                    $url = '/job-step/move-up/' . $model->id;
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-arrow-up"></span>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Params'),
                                    ]
                                    );
                                },
                                'down' => function ($url, $model) {
                                    $url = '/job-step/move-down/' . $model->id;
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-arrow-down"></span>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Params'),
                                    ]
                                    );
                                }
                            ]
                        ],
                    ],
               ]); ?>
            </div>
              <div class="box-footer">
                  <?= Html::a('Add step to job', '/job-step/create/' . $jobId, ['class' => 'btn btn-success']) ?>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</div>
