<?php
//funções da lista telefonica

class Pessoas {
    private $pdo;

    // Construtor da classe
    public function __construct($host, $dbname, $user, $senha) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $senha);
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico: " . $e->getMessage();
            exit();
        }
    }
    //FUNÇÃO PARA BUSCAR DADOS E COLOCAR NA TELA DIREITO
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM contatos ORDER BY nome ");
        $res = $cmd-> fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    //função para cadastrar pessoas no banco de dados 
    public function cadastarPessoa($nome,$telefone,$email)
    {
        //ANTES DE CADASTRAR VERIFICAR SE JA POSSUI O EMAIL CADASTRADO
        $cmd = $this->pdo->prepare("SELECT id FROM contatos WHERE email = :e");
    
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        if($cmd->rowCount()>0) //email ja existe no banco de dados
        {
            return false;
        }else//nao foi encontrado o email 
        {
            $cmd = $this ->pdo->prepare("INSERT INTO contatos (nome,telefone,email) VALUES (:n,:t,:e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }
    }

    //FUNÇÃO PARA EXCLUIR AS INFROMAÇÕES DAS PESSOAS DO BANCO DE DADOS 
    public function excluirPessoa($id)
    {
        $cmd = $this ->pdo->prepare("DELETE FROM contatos WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }

    //FUNÇÃO PARA BUSCAR DADOS DE UMA PESSOA
    public function buscarDadosPessoa($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM contatos WHERE id = :id");
        $cmd ->bindValue(":id",$id);
        $cmd ->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }




    //ATUALIZAR DADOS NO BANCO DE DADOS
   // Função para atualizar dados de uma pessoa
public function atualizarDados($id, $nome, $telefone, $email)
{
  {
        // Atualizar os dados da pessoa
        $cmd = $this->pdo->prepare("UPDATE contatos SET nome = :n, telefone = :t, email = :e WHERE id = :id");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return true; // Dados atualizados com sucesso
    } 
 }
}
?>

