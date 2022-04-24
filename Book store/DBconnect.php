<?php
$host = '127.0.0.1';
$db   = 'book store';
$user = 'root';
$pass = '';
// $conn = mysqli_connect($servername, $username, $password, $dbname);
try {
     $pdo = new PDO("mysql:host=$host;dbname=$db", "$user", "$pass");
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {

}
?>