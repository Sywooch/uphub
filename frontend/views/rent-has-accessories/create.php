<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RentHasAccessories */

$this->title = Yii::t('app', 'Create Rent Has Accessories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rent Has Accessories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-has-accessories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
