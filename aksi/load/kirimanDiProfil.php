<?php
include '../../ig.php';

$user = $_COOKIE['user'];
error_reporting(1);
$limit = $_COOKIE['limitPosProf'];

error_reporting(1);
foreach ($ig->getAllPos($user, $limit) as $row) {
	echo "<a href='../pos/".$row['idpos']."'>".
		 	"<div class='pos'>".
		 		"<img src='../upload/".$row['foto']."'>".
		 	"</div>".
		 "</a>";
}