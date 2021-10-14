<?php

function nama_gelar($str){
    $string = ucwords(strtolower($str));
    foreach (array('-',',','.') as $key => $delimiter) {
        if (strpos($string, $delimiter) !== FALSE) {
            $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
		}
	}
	return strtoupper($string);
	
}