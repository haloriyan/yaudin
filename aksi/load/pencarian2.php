<?php
include '../../ig.php';

$key = $_COOKIE['keycari'];

error_reporting(1);
foreach ($ig->cari($key) as $row) {
	$photo = $ig->getUser($row['username'], "foto_profil");
	echo "<a href='../my/".$row['username']."' style='color: #444;'>".
		 "<div class='hasil'>".
		 	"<img src='../user/".$photo."'>".
		 	"<h4>".$row['username']."</h4>".
		 "</div>".
		 "</a>";
}