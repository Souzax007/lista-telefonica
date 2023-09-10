<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    die("<div style='text-align:center;'>Você não pode acessar essa página porque não está logado.<p><a href=\"index.php\">Login</a></p></div>");
}
?>
