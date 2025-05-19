<?php
$host = "localhost";
$username = "root"; 
$password = "";
$dbname = "animals_db";

$db = new mysqli($host, $username, $password, $dbname);

if (mysqli_connect_errno()) { 
   printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

ini_set('memory_limit', '100M');
session_start();
?>