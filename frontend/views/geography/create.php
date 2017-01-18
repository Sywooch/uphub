<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Geography */

$this->title = 'Create Geography';
$this->params['breadcrumbs'][] = ['label' => 'Geographies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geography-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
