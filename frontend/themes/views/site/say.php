<?php
use yii\helpers\Html;
if ( strcasecmp("hello", $message) != 0 ) echo "Hello ".Html::encode($message);
else echo Html::encode($message);
?>

