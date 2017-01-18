<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Uploads */

$this->title = Yii::t('app', 'Create Uploads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
