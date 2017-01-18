<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

 $this->title = 'แก้ไขข้อมูลส่วนตัว ' ;
if ( $role=Yii::$app->user->identity->role==30) {
	$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลสมาชิก', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูล'; 
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form_up', [
        'model' => $model,
    ]) ?>

</div>
