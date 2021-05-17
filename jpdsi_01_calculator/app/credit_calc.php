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

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
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

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ($messages)) { // gdy brak błędów
	
	//konwersja parametrów na int
	$kwota = intval($kwota);
	$lata = intval($lata);
	$oprocentowanie = floatval($oprocentowanie);
	
	//wykonanie operacji

	//oprocentowanie w skali miesiąca
	$result = ($kwota + $kwota * $oprocentowanie) / (12 * $lata);

	//oprocentowanie w skali roku 
	// $result = $kwota / (12 * $lata) + ($kwota / (12 * $lata)) * $oprocentowanie;
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'credit_calc_view.php';