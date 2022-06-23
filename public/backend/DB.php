<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'fakecar';

$connect = mysqli_connect($server, $user, $password, $db);

if ($connect->connect_errno) die('Nie ma połączenia z MySQL');
