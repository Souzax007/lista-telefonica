<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $host = 'localhost'; // Endereço do servidor de banco de dados
    $dbname = 'Pessoas'; // Nome do banco de dados
    $username = 'root'; // Nome de usuário do banco de dados
    $password = ''; // Senha do banco de dados
    
    // Cria uma nova conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configura o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Agora você pode usar a variável $pdo para executar consultas SQL
    
    // Por exemplo, você pode executar uma consulta para buscar dados
    $sql = "SELECT * FROM usuarios";
    $result = $pdo->query($sql);
    
    // Loop através dos resultados, se houver algum
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id'] . " Nome: " . $row['nome'] . "<br>";
    }
    
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibe a mensagem de erro
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>

