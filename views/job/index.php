<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PjeJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Jobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-job-index">

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
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
                        'title',
                        'description:ntext',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {steps} {recipients} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-default">View &nbsp;<i class="glyphicon glyphicon-eye-open"></i></button>', $url);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-default">Update &nbsp;<i class="glyphicon glyphicon-pencil"></i></button>', $url);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<button class="btn btn-danger">Delete &nbsp;<i class="glyphicon glyphicon-trash"></i></button>', $url,
                                            ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST']
                                        );
                                },
                                'steps' => function ($url, $model) {
                                    $url = '/job-step/index/'.$model->id;

                                    return Html::a(
                                        '<button class="btn btn-default">Steps &nbsp;<i class="fa fa-puzzle-piece"></i></button>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Steps'),
                                    ]
                                    );
                                },
                                'recipients' => function ($url, $model) {
                                    $url = '/recipient/index/'.$model->id;

                                    return Html::a(
                                        '<button class="btn btn-default">Recipients &nbsp;<i class="glyphicon glyphicon-envelope"></i></button>',
                                        $url,
                                    [
                                        'title' => Yii::t('app', 'Recipients'),
                                    ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</div>
