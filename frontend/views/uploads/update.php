<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Uploads */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Uploads',
]) . ' ' . $model->upload_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->upload_id, 'url' => ['view', 'id' => $model->upload_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="uploads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
