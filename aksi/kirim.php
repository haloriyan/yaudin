<?php
include '../ig.php';

$id = rand(1,99999999);
$sesi = $ig->cekSesi();
$foto = $_POST['namafile'];
$konten = $_POST['konten'];
$dikirim = time();

$ig->post($id, $sesi, $foto, $konten, "", $dikirim);