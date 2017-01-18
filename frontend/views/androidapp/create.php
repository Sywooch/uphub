<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Androidapp */

$this->title = Yii::t('app', 'Create Androidapp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Androidapps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="androidapp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
