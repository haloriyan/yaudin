<?php
include '../../ig.php';

$id = $_COOKIE['idpos'];
$sesi = $ig->cekSesi();

$likers = $ig->getPos($id, "likers");
$pLike = explode(",", $likers);
$totLike = count($pLike);

foreach ($pLike as $key => $value) {
	if($sesi == $pLike[$key]) {
		$saya = "Anda";
		unset($pLike[$key]);
	}else {
		$saya = "";
	}
	$pLikeBaru = implode(",", $pLike);
}

$pLikes = explode(",", $pLikeBaru);
$totLikeBaru = count($pLikes);
$terakhirLike = $pLikes[$totLikeBaru -1];

if($likers == "") {
	$ketLike = "";
}else if($totLike == 1) {
	if($terakhirLike == "" && $likers != "") {
		$terakhirLike = "Anda";
	}else {
		$terakhirLike = $pLikes[$totLikeBaru -1];
	}
	$ketLike = $terakhirLike." menyukai ini";
}else if($totLike == 2) {
	$lain = $pLikeBaru;
	$ketLike = $saya." dan ".$lain." menyukai ini";
}
else {
	$terakhirLike = $pLikes[$totLikeBaru -1];
	$totLike2 = $totLike - 1;
	$ketLike = $saya.", ".$terakhirLike." dan ".$totLike2." orang lainnya menyukai ini";
}

echo $ketLike;