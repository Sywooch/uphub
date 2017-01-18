<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlbumnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albumns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albumn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Albumn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'event_name',
            'customer_name',
            'location',
            'start_date',
            // 'province',
            
            // 'customer_mobile_phone',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
