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


function transformDate($value, $format = 'm-d-Y')
{
    try {
        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    } catch (\ErrorException $e) {
        return \Carbon\Carbon::createFromFormat($format, $value);
    }
}