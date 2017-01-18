<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Amphur */

$this->title = 'Create Amphur';
$this->params['breadcrumbs'][] = ['label' => 'Amphurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amphur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
