<?php
include '../ig.php';

$idpos = $_POST['idpos'];
$sesi = $ig->cekSesi();
$aksi = $_POST['aksi'];

if($aksi == "like") {
	$ig->like($idpos, $sesi);
}else {
	$ig->unlike($idpos, $sesi);
}