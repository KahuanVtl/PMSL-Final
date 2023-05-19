<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "usuarios";
$port = "3306";

//Conexão com a porta
$conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}