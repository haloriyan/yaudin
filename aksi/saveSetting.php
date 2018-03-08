<?php
include '../ig.php';

$sesi = $ig->cekSesi();

$tipe = $_POST['tipe'];
if($tipe == "umum") {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$bio = $_POST['bio'];

	$yangDiganti = "nama,email,bio";
	$p = explode(",", $yangDiganti);

	$val = $nama.",".$email.",".$bio;
	$v = explode(",", $val);

	for ($i=0; $i < count($p); $i++) { 
		$ig->ubahUser($sesi, $p[$i], $v[$i]);
	}
}else if($tipe == "privasi2") {
	$opsi = $_POST['opsi'];

	$ig->ubahUser($sesi, "komentar", $opsi);
}else if($tipe == "privasi") {
	$opsi = $_POST['opsi'];
	$ig->ubahUser($sesi, "privat", $opsi);
}