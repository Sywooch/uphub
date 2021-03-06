<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\AccessoriesHasRoom */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Accessories Has Room',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accessories Has Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="accessories-has-room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
