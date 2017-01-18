<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Albumn */

$this->title = 'Create Albumn';
$this->params['breadcrumbs'][] = ['label' => 'Albumns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albumn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'initialPreview'=>[],
    	'initialPreviewConfig'=>[]
    ]) ?>

</div>
