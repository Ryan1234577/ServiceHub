<?php
ini_set('display_erros', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
if($_SERVER['REQUEST_METHOD']=="POST"){
require_once "config/conexao.php";
$nome = $_POST ['txtnome'];
$descricao = $_POST ['txtdescricao'];
$preco = $_POST ['txtpreco'];
 
// ==== Inserindo Serviços ====
$pdo->prepare();
$sql = "insert servicos (nome, descricao, preco) values(:nome, :descricao, :preco)";
$cmd = obterPdo()->prepare($sql);
$cmd->execute([':nome'=>$nome, ':descricao'=>$descricao, ':preco'=>$preco]);
$id = obterPdo()->lastInsertId();     //Armazena o ID do serviço que acabou de ser inserido
 
if(isset($id))/*SE valor associado em $ID?*/{
    echo "Serviço cadastrado com sucesso, com id ".$id;
}
 
else{
    echo "Falha ao cadastrar o serviço!!";
 }
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <title>Formulário de Cadastro de Serviços</title>
</head>
 
<body>
    <form action="formservico.php" method="post">
        <input type="number" name="txtid" id="" hidden>
 
        <label for="txtnome">Nome</label>
        <input type="text" name="txtnome" id="">
 
        <label for="txtdescricao">Descrição</label>
        <input type="text" name="txtdescricao">
 
        <label for="txtpreco">Preço</label>
        <input type="text" name="txtpreco">
 
        <button type="submit">Gravar</button>
    </form>
</body>
 
</html>
 