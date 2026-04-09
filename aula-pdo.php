<?php
include_once "config/conexao.php";
 
$sql = "select * from servicos where id = :id or nome = :nome";
$cmd = $pdo->prepare($sql);
$cmd->execute([":id"=>$id, ":nome"=>$nome]);
$servicos = $cmd->fetchAll(PDO::FETCH_ASSOC);

//$sql = "select * from servicos";
//$cmd = $pdo->prepare($sql);
//$cmd->execute();
//$servicos = $cmd->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from usuarios";
$cmd = $pdo->prepare($sql);
$cmd->execute();
$usuarios = $cmd->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from clientes";
$cmd = $pdo->prepare($sql);
$cmd->execute();
$clientes = $cmd->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Aula pdo <?php ?></title>
</head>
<body>
    <h2>Lista de Serviços</h2>
    <table border="1" cellpadding="5" >
       <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Descontinuado</th>
       </tr>
       <?php foreach($servicos as $servico): ?>
       
        <tr>
            <td><?php echo $servico['id']; ?></td>
            <td><?php echo $servico['nome']; ?></td>
            <td><?php echo $servico['descricao']; ?></td>
            <td><?php echo $servico['preco']; ?></td>
            <td><?php echo $servico['descontinuado']?"Sim":"Não"?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h3>Lista de usuarios</h3>
    <table border="1" cellpadding="7">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Tipo</th>
            <th>Ativo</th>
            <th>Primeiro Login</th> 
        </tr>
        <?php foreach($usuarios as $usuario): ?>
            <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['senha']; ?></td>
            <td><?php echo $usuario['tipo']; ?></td>
            <td><?php echo $usuario['ativo']; ?></td>
            <td><?php echo $usuario['primeiro_login']; ?></td>
            </tr>
             <?php endforeach; ?>
    </table>

    <h4>Lista de Clientes</h4>
    <table border="1" cellpadding="7">
        <tr>
            <th>ID</th>
            <th>Id do user</th>
            <th>Telefone</th>
            <th>CPF</th>
        </tr>
        <?php foreach($clientes as $cliente): ?>
            <tr>
            <td><?php echo $cliente['id']; ?></td>
            <td><?php echo $cliente['usuario_id']; ?></td>
            <td><?php echo $cliente['telefone']; ?></td>
            <td><?php echo $cliente['cpf']; ?></td>
            </tr>
             <?php endforeach; ?>
    </table>
            <hr>
    <form action="resform.php" method="post">
        <input type="text" name="txtnome" id="">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

