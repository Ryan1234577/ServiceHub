<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $senha = password_hash("123456",PASSWORD_DEFAULT);
// echo $senha;
//$usuario = new Usuario();
//$usuario->setNome('Milharino Santos');
//$usuario->setEmail('mil@harino.sa');
//$usuario->setSenha('mI2026@TV');
//$usuario->setTipo(2);

//if($usuario->inserir()){
 //   echo "Usuário ".$usuario->getNome()." inserido com sucesso com o ID". $usuario->getId() ;
//}

require_once "class/Usuario.php";
//testando update
$usuario = new usuario();
// if($usuario->buscarPorId(30)){
//     echo"<prev>";
// }

//  else{
//         echo "Usuário não cadastrado";
//         die();
//     }
//     $usuario ->setNome("Marciano Santos");
//     if($usuario->atualizar())
//     print_r($usuario);
//     echo "<hr>";
//     echo "<pre>";
    $usuario->buscarPorId(30);
    $usuario->Setsenha(password_hash("123456dfjodjkf",  PASSWORD_DEFAULT));
    echo "Senha atualizadaa com sucesso";

?>