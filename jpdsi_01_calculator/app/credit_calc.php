<?php

require_once dirname(__FILE__).'/../config.php';

$kwota = $_REQUEST['kwota'];
$lata = $_REQUEST['lata'];
$oprocentowanie = $_REQUEST['oprocentowanie'];


if ( ! (isset($kwota) && isset($lata) && isset($oprocentowanie))) {
	
	$messages [] = 'Błąd w wywołaniu aplikacji. Brak jednego z parametrów';
}


if ( $kwota == "") {
	$messages [] = 'Nie podano kwoty pozyczki';
}
if ( $lata == "") {
	$messages [] = 'Nie podano czasu na jaki została wzięta pozyczka';
}
if($oprocentowanie == ""){
	$messages[] = "Nie podano oprocentowania";
}

if (empty( $messages )) {	
	
	if (! is_numeric($kwota)) {
		$messages [] = 'Kwota pozyczki nie jest liczbą całkowitą';
	}
	
	if (! is_numeric($lata)) {
		$messages [] = 'Okres spłacenia pozyczki nie został podany jako liczba całkowita';
	}
	if(! is_numeric($oprocentowanie)){
		$messages[] = 'Oprocentowanie nie jest wartością całkowitą'; 
	}	

}

if (empty ($messages)) { 
	
	$kwota = intval($kwota);
	$lata = intval($lata);
	$oprocentowanie = floatval($oprocentowanie);
	
	
	$result = ($kwota + $kwota * $oprocentowanie) / (12 * $lata);
	
}
include 'credit_calc_view.php';
