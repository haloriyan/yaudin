<?php
include '../ig.php';

$username = $_POST['username'];
$password = $_POST['password'];

$ig->login($username, $password);