<?php
ini_set('display_erros', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
if($_SERVER['REQUEST_METHOD']=="POST"){
require_once "config/conexao.php";
$nome = $_POST ['txtnome'];
$turma = $_POST ['txtturma'];
$disciplina = $_POST ['txtdisciplina'];
$data_nascimento = $_POST ['datedatanascimento']; 
 
// ==== Inserindo alunos ====
$sql = "insert servicos (id_aluno, nome, turma, disciplina) values(:id_aluno, :nome, :turma, :disciplina , :data_nascimento)";
$cmd = $pdo->prepare($sql);
$cmd->execute([':nome'=>$nome, ':turma'=>$turma, ':disciplina'=>$disciplina, ':data_nascimento'=>$data_nascimento]);
$id = $pdo->lastInsertId(); 

if(isset($id))/*SE valor associado em $ID?*/{
    echo "Aluno Cadastrado com sucesso, com id ".$id;
}
 
else{
    echo "Falha ao cadastrar novo aluno!!";
 }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <title>Alunos</title>
</head>
 
<body>
    <form action="formalunos.php" method="post">
        <input type="number" name="txtid" id="" hidden>
 
        <label for="txtnome">Nome</label>
        <input type="text" name="txtnome" id="">
 
        <label for="txtdescricao">Turma</label>
        <input type="text" name="txtturma">
 
        <label for="txtpreco">Disciplina</label>
        <input type="text" name="txtdisciplina">

        <label for="datedatanascimento">Disciplina</label>
        <input type="date" name="datenasciemnto">
 
        <button type="submit">Gravar Aluno</button>
    </form>
</body>
 
</html>
 