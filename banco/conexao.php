<?php
$name = "localhost";
$username = "root";
$senha = "";
$dbname = "bd_trovata";

$conn = new mysqli($name, $username, $senha, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>