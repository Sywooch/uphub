<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Privilege;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการข้อมูลสมาชิก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>
        "ผลการค้นหา{begin}-{end} คน หน้าที่ {page} จาก {pageCount} หน้า",
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            'firstname',
            'lastname',
            //'privilege_id',

            [
              'attribute'=>'privilege_id',
              //'format'=>'raw',
              'value'=> function ($data)
                {
                  return $data->privilege->valueEn;
                },
                'filter'=> Html::activeDropDownList(
                  $searchModel,
                  'privilege_id',
                    ArrayHelper::map(
                      Privilege::find()->asArray()->all(),
                      'id',
                      'valueTh'
                    ),
                    ['class'=>'form-control','prompt'=>'เลือกสิทธิ์']
                  ),
              ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
