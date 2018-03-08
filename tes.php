<?php

$follower = "sobry_punggawa,seto.kaybaa,haloriyan";
$saya = "seto.kaybaa";

$foll = explode(",", $follower);

foreach ($foll as $key => $value) {
	// $baru = unset($saya, $foll[$key]);
	if($saya == $foll[$key]) {
		unset($foll[$key]);
	}
	$baru = implode(",", $foll);
}
echo $baru;