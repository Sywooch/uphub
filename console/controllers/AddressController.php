<?php
namespace console\controllers;

use yii\console\Controller;
use frontend\models\Address;

class AddressController extends Controller
{
    public function actionInit()
    {
    	$model = new Address();
    	$model->setAttribute('id', 1);
    	$model->setAttribute('number', '23');
    	$model->setAttribute('district_id', 1);
    	$model->save();
        echo "test";
    }
    
    
    public function actionInsertAddress(){
    	echo "insertion success";
    }
}
