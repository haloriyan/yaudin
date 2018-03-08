<?php
include '../../ig.php';

$id = $_COOKIE['idpos'];
error_reporting(1);
$limitKomen = $_COOKIE['limitKomen'];
if(empty($limitKomen)) {
	$limitKomen = 20;
}

foreach ($ig->getKomen($id, $limitKomen) as $row) {
	echo "<div>".
		 	"<b><a href='../my/".$row['user']."'>".$row['user']."</a></b> ".
		 	$row['komentar'].
		 "</div>";
}