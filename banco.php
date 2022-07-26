<?php
session_start();
//include('verifica_login.php');
?>
<h1></h1>
<h2>Olá, <?php echo $_SESSION['usuario'];?></h2>
<h3 id="logout"><a href="logout.php"><button class="button">Sair</button></a></h3>

<?php
 
 // Verificar se foi enviando dados via POST
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
     $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : NULL;
     $cidade1 = (isset($_POST["cidade1"]) && $_POST["cidade1"] != null) ? $_POST["cidade1"] : NULL;
     $cidade2 = (isset($_POST["cidade2"]) && $_POST["cidade2"] != null) ? $_POST["cidade2"] : "";
     $cidade3 = (isset($_POST["cidade3"]) && $_POST["cidade3"] != null) ? $_POST["cidade3"] : "";
     $cidade4 = (isset($_POST["cidade4"]) && $_POST["cidade4"] != null) ? $_POST["cidade4"] : "";
     $cidade5 = (isset($_POST["cidade5"]) && $_POST["cidade5"] != null) ? $_POST["cidade5"] : "";
     
     
 } else if (!isset($id)) {
     // Se não se não foi setado nenhum valor para variável $id
     $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
     $nome = NULL;
     $cidade1 = NULL;
     $cidade2 = NULL;
     $cidade3 = NULL;
     $cidade4 = NULL;
     $cidade5 = NULL;
     
 }
 try {
    $conexao = new PDO("mysql:host=127.0.0.1; dbname=crudsimples", "root");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE grupos_cidades SET nome=?, cidade1=?, cidade2=?, cidade3=?, cidade4=?, cidade5=? WHERE id = ?");
            $stmt->bindParam(7, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO grupos_cidades (nome, cidade1, cidade2, cidade3, cidade4, cidade5) VALUES (?, ?, ?, ?, ?, ?)");
        }
        
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $cidade1);
        $stmt->bindParam(3, $cidade2);
        $stmt->bindParam(4, $cidade3);
        $stmt->bindParam(5, $cidade4);
        $stmt->bindParam(6, $cidade5);
        
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<div id ='alert'><br>Dados cadastrados com sucesso!</div>";
                $nome = NULL;
                $cidade1 = NULL;
                $cidade2 = NULL;
                $cidade3 = NULL;
                $cidade4 = NULL;
                $cidade5 = NULL;
                
            } else {
                echo "<div id ='alert'><br>Erro ao tentar efetivar cadastro</div>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM grupos_cidades WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $cidade1 = $rs->cidade1;
            $cidade2 = $rs->cidade2;
            $cidade3 = $rs->cidade3;
            $cidade4 = $rs->cidade4;
            $cidade5 = $rs->cidade5;
            
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
        
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM grupos_cidades WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
        echo "<div id ='alert'><br>Registo foi excluído com êxito!</div>";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dados de Cidades</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <form action="?act=save" method="POST" name="form1" >
        <br>
            
            <hr>
            <input type="hidden" name="id" <?php
            // Preenche o id no campo id com um valor "value"
            if (isset($id) && $id != null || $id != "") {
                echo "value=\"{$id}\"";
            }
            ?> />
            Nome:
            <input type="text" name="nome" <?php
            // Preenche o nome no campo nome com um valor "value"
            if (isset($nome) && $nome != null || $nome != ""){
                echo "value=\"{$nome}\"";
            }
            ?> />
            &nbsp;&nbsp; Cidade 1:
            <input type="text" name="cidade1" <?php
            if (isset($cidade1) && $cidade1 != null || $cidade1 != ""){
                echo "value=\"{$cidade1}\"";
            }
            ?> />
            &nbsp; Cidade 2:
            <input type="text" name="cidade2" <?php
            // Preenche o email no campo email com um valor "value"
            if (isset($cidade2) && $cidade2 != null || $cidade2 != ""){
                echo "value=\"{$cidade2}\"";
            }
            ?> />
            <br>
            <br>
            Cidade 3:
            <input type="text" name="cidade3" <?php
            if (isset($cidade3) && $cidade3 != null || $cidade3 != ""){
                echo "value=\"{$cidade3}\"";
            }
            ?> />
            
            &nbsp;   Cidade 4:
            <input type="text" name="cidade4" <?php
            if (isset($cidade4) && $cidade4 != null || $cidade4 != ""){
                echo "value=\"{$cidade4}\"";
            }
            ?> />
            &nbsp;   Cidade 5:
            <input type="text" name="cidade5" <?php
            if (isset($cidade5) && $cidade5 != null || $cidade5 != ""){
                echo "value=\"{$cidade5}\"";
            }
            ?> />
           
            
            &nbsp;
           <input id= "b1" type="submit" value="Salvar" />
           &nbsp;
           <input id= "b2" type="reset" value="Novo" />
           <hr>
        </form>
        <table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Cidade 1</th>
        <th>Cidade 2</th>
        <th>Cidade 3</th>
        <th>Cidade 4</th>
        <th>Cidade 5</th>
        <th>Opções</th>
    </tr>
    <?php
try {
 
    $stmt = $conexao->prepare("SELECT * FROM grupos_cidades ORDER BY id");
 
        if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                //$media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;
                echo "<tr>";
                echo "<td>".$rs->nome."</td><td>".$rs->cidade1."</td><td>".$rs->cidade2."</td><td>".$rs->cidade3."</td>
                <td>".$rs->cidade4."</td><td>".$rs->cidade5."</td>
                <td><center><a href=\"?act=upd&id=" . $rs->id . "\"><button>Alterar</button></a>"
                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                ."<a href=\"?act=del&id=" . $rs->id . "\"><button color='primary'>Excluir</button></a></center></td>";
                echo "</tr>";
            }
        } else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}
?>
</table>
    </body>
</html>