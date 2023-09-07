<?php
session_start();
$dbHost = 'localhost';
$dbName = 'guvi';
$dbUsername = 'root';
$dbPassword = '';
$dbc= mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName); 
?>