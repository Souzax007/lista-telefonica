<?php
//conexão da tela de login ao banco

$usuario = "root";
$senha = "";
$database = "Pessoas"; // Correção da variável
$host = "localhost";

$mysqli = new mysqli($host, $usuario, $senha, $database); // Correção da variável

if ($mysqli->error) { // Verificar se houve um erro de conexão
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}
?>