<?php
$login = $_GET['login'];
$senha = $_GET['senha'];

if ($login=='demo' && $senha=='demo') {
	$redirect = "minhaterceirapagina.php";
	header("location:$redirect");
} else{
	print("not ok");
}