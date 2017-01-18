<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Zipcode */

$this->title = 'Create Zipcode';
$this->params['breadcrumbs'][] = ['label' => 'Zipcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zipcode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
