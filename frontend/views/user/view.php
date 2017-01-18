<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
if ( $role=Yii::$app->user->identity->role==30) {
	$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลสมาชิก', 'url' => ['index']];
}$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h2> คุณ  <?= Html::encode($this->title) ?></h2>

<?php echo  Html::a('แก้ไขข้อมูลส่วนตัว', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
        	'fullname',
            'email:email',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>

</div>
<br>