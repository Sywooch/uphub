<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Amphur */

$this->title = 'Update Amphur: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Amphurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="amphur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
