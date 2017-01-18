<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Albumn */

$this->title = 'Update Albumn: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Albumns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="albumn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    		'initialPreview'=>[],
    		'initialPreviewConfig'=>[]
    ]) ?>

</div>
