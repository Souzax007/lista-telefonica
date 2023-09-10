<?php
//aqui é a parte de da tela de login
error_reporting(E_ALL);
include('conexao_msqli.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        // Função para limpar o que vem no input do email
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
        
       

        $sql_code = "SELECT * FROM conta WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code);
        //$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ".$mysqli->error);

        $quantidade = $sql_query->num_rows;
        
        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)){
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            
            header("Location:main.php");
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
     <link rel="shortcut icon" href="img/livro-de-contato.ico" type="image/x-icon">
     <link rel="stylesheet" href="style/login.css">
</head>
<body class="text-center">
    
    <main class="form-signin">
    <form action="" method="post">
        <img class="mb-4" src="icone-lista.png" alt="icone-lista" width="72" height="70">
        <h1 class="h3 mb-3 fw-normal">Bem vindo(a)</h1>
    
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" >
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="senha" >
          <label for="floatingPassword">Senha</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        
        <div class="link-r">
            <p>Não tenho conta ? <a href="tela_de_cadastro.php">Cadastre-se</a></p>
        </div>

        <p class="mt-5 mb-3 text-muted">&copy; 2023</p>

        
      </form>
    </main>
      </body>
</html>