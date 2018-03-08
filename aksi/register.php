<?php
include '../ig.php';

$id = rand(1,999999);
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$ig->register($id, $nama, $email, $username, $password, "","", "", "defaultYaudin.jpeg");