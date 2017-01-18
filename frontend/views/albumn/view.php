<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Albumn */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Albumns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albumn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ref',
            'event_name',
            'detail:ntext',
            'start_date',
            'end_date',
            'location',
            'customer_name',
            'customer_mobile_phone',
            'province_id',
        ],
    ]) ?>
    <div class="panel panel-default">
  <div class="panel-body">
     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->event_name)]);?>
  </div>
</div>

</div>
