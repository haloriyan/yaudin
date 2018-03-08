<?php

$nama = $_POST['namakuki'];
$value = $_POST['isikuki'];
$time = $_POST['durasi'];

setcookie($nama, $value, time() + $time, "/");