<?php
//aqui é a parte da lista telefonica
include('protect.php');
$_SESSION['id'];

error_reporting(E_ALL);

require_once 'pessoa.php';
$p = new Pessoas("localhost", "Pessoas", "root", "");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista-telefonica</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <?php
    if (isset($_POST['nome']))
    //CLICOU NO BOTÃO CADASTRAR OU EDITAR
    {
        //------------------------editar-----------------------//
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
            $id_upd = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if (!empty($nome) && !empty($telefone) && !empty($email)) {

                //ATUALIZAE
                $p->atualizarDados($id_upd, $nome, $telefone, $email);
                header("Location:main.php");

            } else {

                ?>
                    <div id="alerta" >
                        <img src="/img/aviso.png" alt="aviso">
                        <h4>preencha todos os campos</h4>
                    </div> 
                    <?php
            }

        }
        //------------------------cadastrar--------------------//
        else {

            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if (!empty($nome) && !empty($telefone) && !empty($email)) {

                //cadastrar
                if ($p->cadastarPessoa($nome, $telefone, $email)) {
                    ?>
                    <div id="sucesso">
                        <h4>Cadastrado com succeso !!</h4>
                    </div> 
                    <?php

                }

            } else {
                ?>
                <div class="alerta" >
                    <h4>preencha todos os campos</h4>
                </div> 
                <?php
            }

        }
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        if (!empty($nome) && !empty($telefone) && !empty($email)) {

            //cadastrar
            if ($p->cadastarPessoa($nome, $telefone, $email)) {
                header("location: main.php");
            }

        }
    }

    ?>

    <?php
    if (isset($_GET['id_up'])) //SE A PESSOA CLICOU EM EDITAR 
    {
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscarDadosPessoa($id_update);
    }

    ?>
    <section id="direita">
        <form action="" method="post">
            <h1><?php if (isset($res)) {
                echo "Editar contato";
            } else {
                echo "Cadastrar contatos";
            }?></h1>


            <label for="nome">NOME</label>
            <input type="text" name="nome" id="nome" value="<?php if (isset($res)) {
                echo $res['nome'];
            }
            ?>">

            <label for="telefone">TELEFONE</label>
            <input type="number" name="telefone" id="telefone" value="<?php if (isset($res)) {
                echo $res['telefone'];
            }
            ?>">

            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" value="<?php if (isset($res)) {
                echo $res['email'];
            }
            ?>">

            <input class="botao1" type="submit" value="<?php if (isset($res)) {
                echo "Atualizar";
            } else {
                echo "Cadastrar";
            }
            ?>">

            <div  >
            <a class="botao2" href="sair.php" class="meu-botao">Sair</a>
            </div>

        </form>

    </section>
    <section id="esquerda">

    <table class="table table-striped table-dark">
     <thead>
        <tr id="titulo" >
      <th scope="col">Nome</th>
      <th scope="col">Telefone</th>
      <th scope="col">Email</th>
      <th scope="col">Funções</th>
        </tr>
    </thead>

            <?php
            $dados = $p->buscarDados();
            if (count($dados) > 0) //tem pessoas no banco 
            {
                for ($i = 0; $i < count($dados); $i++) {
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v) {
                        if ($k != "id") {
                            echo "<td>" . $v . "</td>";
                        }

                    }
                    ?>
                    <td class="btn-f" >
                        <a class="editar" href="main.php?id_up=<?php echo $dados[$i]['id']; ?>">Editar</a>
                        <a class="excluir" href="main.php?id=<?php echo $dados[$i]['id']; ?>">Excluir<i class="bi bi-trash3-fill"></i></a>
                    </td>
                    <?php
                    echo "</tr>";
                }
            } else //o banco de dados esta vazio
            {


            ?>

                    <div class="aviso">
                        <h4 ><img src="/img/aviso.png" alt="aviso">Não a pessoas cadastradas<img src="/img/aviso.png"></h4>
                    </div> 
                    <?php
            }            

            
            ?>

        </table>
    </section>
</body>

</html>

<?php

if (isset($_GET['id'])) {
    $id_pessoa = addslashes($_GET['id']);
    $p->excluirPessoa($id_pessoa);
    header("Location:main.php");
}
?>