<?php

namespace frontend\models;

class ReplaceObject {
	public static function replace($old,$new) {
		$add = [ ];
		$remove = [];
		$all = array_unique(array_merge($old,$new));
		foreach ( $all as $item ) {
			
			$inNew = false;
			$inOld = false;
			
			if (($key = array_search ( $item,$new )) !== FALSE) {
				$inNew = true;	
			}
			if( ($key = array_search ($item, $old ))  !== FALSE) {
				$inOld = true;
			}
			
			if ($inNew && !$inOld) $add[] = $item;
			if (!$inNew && $inOld) $remove[] = $item;
		} 

		return [ 
				$add,
				$remove 
		];
	}
}