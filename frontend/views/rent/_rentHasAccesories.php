<?php

foreach ( $accessories as $accessory ) {
	$accessoriesList [$accessory->id] = $accessory->name;
}

$checklist = [];
foreach ( $modelHasAccessories as $_modelHasAccessories ) {
	$checklist [] = $_modelHasAccessories ['accessories_id'];
}
$modelHasAccessoriesOne->accessories_id = $checklist;

//echo $form->field ( $modelHasAccessoriesOne, 'rent_id' )->input ( 'hidden',['value'=>$modelRent->id] );
echo $form->field ( $modelHasAccessoriesOne, 'accessories_id' )->checkBoxList ( $accessoriesList );
/* echo $form->field ( $modelHasAccessories, 'rent_id' )->input ( 'hidden' );

$i = 0;
foreach ( $modelHasAccessories as $_modelHasAccessories ) {
	$checklist [$i ++] = $_modelHasAccessories ['accessories_id'];
	echo $_modelHasAccessories->accessories_id . "<br>";
}

$modelHasAccessories->accessories_id = $checklist; */

?>