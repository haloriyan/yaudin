<?php
include '../ig.php';

$id = rand(1,999999999);
$idpos = $_COOKIE['idpos'];
$user = $ig->cekSesi();
$komentar = $_POST['komentar'];
$dikirim = time();

$ig->komentari($id, $idpos, $user, $komentar, $dikirim);