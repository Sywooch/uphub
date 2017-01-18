<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AccessoriesHasRoom */

$this->title = Yii::t('app', 'Create Accessories Has Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accessories Has Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessories-has-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
