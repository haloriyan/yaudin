<?php

$limit = $_COOKIE['limitPosProf'];
$tambah = $limit + 9;

setcookie('limitPosProf', $tambah, time() + 3650, "/");

?>