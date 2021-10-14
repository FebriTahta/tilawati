<?php

function nama_gelar($str){
    $string = ucwords(strtolower($str));
	$tanda	= array('-','\'','.');
    foreach ($tanda as $key => $delimiter) {
        if (strpos($string, $delimiter) !== FALSE) {
            $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
		}
    }
	// if(substr($str,0,2) == 'hj' || substr($str,0,2) == 'Hj' || substr($str,0,2) == 'HJ' || substr($str,0,2) == 'hJ' 
	// 	|| substr($str,0,2) == 'Dr' || substr($str,0,2) == 'dr' || substr($str,0,2) == 'dR' || substr($str,0,2) == 'DR'
	// )
	// {
	// 	return substr($string,0,2).strtoupper(substr($string,2,-5)).substr($string,-5);
	// }else{
		
	// }
	return strtoupper(substr($string,0,-5)).substr($string,-5);
}