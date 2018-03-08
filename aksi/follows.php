<?php
include '../ig.php';

$user = $_POST['user'];
$aksi = $_POST['aksi'];
$sesi = $ig->cekSesi();

if($aksi == "follow") {
	$ig->follow($sesi, $user);
}else {
	$ig->unfoll($sesi, $user);
}