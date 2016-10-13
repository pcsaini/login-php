<?php
function email($to,$subject,$body,$from){
	mail($to,$subject,$body,$from);
}

function logged_in_redirect(){
	if (logged_in() === true) {
		header('Location: index.php');
		exit();
	}
}


function protecting_page(){
	if (logged_in() === false) {
		header('Location: protect.php');
		exit();
	}
}

function array_santize(&$item){
	$item = mysql_real_escape_string($item);
}

function sanitize($data){
	return mysql_real_escape_string($data);
}


function output_error($errors){
	$output = array();
	foreach ($errors as $error) {
		echo $error, ', ';
	}
	//return '<ul><li>'. implode('</li><li>', $errors). '</li></ul>';
}
function output_errors($errors){
	/*$output = array();
	foreach ($errors as $error) {
		echo $error, ', ';
	}*/
	return '<ul><li>'. implode('</li><li>', $errors). '</li></ul>';
}
?>