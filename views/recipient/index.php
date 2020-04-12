<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PjeRecipientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recipients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pje-recipient-index">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
                <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'email:email',
                        'notify_on_success',
                        'notify_on_failure',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                </div>
                <div class="box-footer">
                    <?= Html::a('Add recipient to job', '/recipient/create/'.$jobId, ['class' => 'btn btn-success']); ?>
                </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</div>
