<?php

session_start();
require_once "class/Cliente.php";
require_once "class/Usuario.php";
require_once "class/Solicitacao.php";
require_once "class/Servico.php";
require_once "class/ServicoSolicitacao.php";


if ($_SERVER['REQUEST_METHOD'] !=="POST"){
    header("location:contratar.php?erro=Invalid Request");
}

//verificação de segurança (se o usuario logado tem o direito de carregar esta página)
//CSRF
$token = $_POST['csrf_token']??"";
if (!$token || !isset($_SESSION['csrf_token']) || $token  !== $_SESSION['csrf_token'])
{
    header("location: contratar.php?erro=Falha de segurança CSRF detectada.");
    exit();
}

//inputs (são os campos do formulário)
$nome = filter_input(INPUT_POST,'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST,'telefone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$endereco = filter_input(INPUT_POST,'endereco', FILTER_UNSAFE_RAW);
$data_preferida = filter_input(INPUT_POST,'data_preferida', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cpf = preg_replace('/\D/','',$_POST['cpf'] ?? "");
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_UNSAFE_RAW);
$servicos_ids=$_POST['servicos_id'] ?? []; // array de serviços

//validação dos serviços:
if(!is_array($servicos_ids)){
    header("location: contratar.php?erro=Selecione ao menos um serviço");
    exit();
}
$servico_validos= [];
foreach($servicos_ids as $id){
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $servicos_validos[] = $id;
}
//validações gerais
if(!$nome || strlen($nome) < 4){
    header("location: contratar.php?erro=Nome inválido.");
    exit();
}

if(!$email){
    header("location: contratar.php?erro=Email inválido.");
    exit();
}


if(!$telefone || strlen($telefone) < 4){
    header("location: contratar.php?erro=Telefone inválido.");
    exit();
}


if(!$endereco || strlen($endereco) < 5){
    header("location: contratar.php?erro=Endereço inválido.");
    exit();
}


if(!$descricao || strlen($descricao) < 10){
    header("location: contratar.php?erro=Descreva melhor o problema.");
    exit();
}

if(!$cpf && strlen($cpf) != 11){
    header("location: contratar.php?erro=CPF inválido, digite 11 números.");
    exit();
}
if(count($servico_validos) < 1){
   header("location: contratar.php?erro=Selecione ao menos um serviço válido."); 
}
if(!$data_preferida){
    $ts= strtotime($data_preferida);
    if($ts === false){
       header("location: contratar.php?erro=Data Inválida.");  
       exit();
    }
    if($ts < strtotime(date('Y-m-d')))
        header("location: contratar.php?erro=A data não pode ser anterior a de hoje.");  
       exit();
    
}

// verificar se o usuario existe
$usuarioBanco = new Usuario();
if ($usuarioBanco ->buscarPorEmail($email)==false){
    // se retornou falso é por que não tem usuário com este email no banco então gravamos!!!!
    $usuario = new Usuario();
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setTipo(2);
    $usuario->setAtivo(true);
    $usuario->setSenha("123456");
    $usuario->setPrimeiroLogin(true);
    if (!$usuario->inserir()){
        header("location: contratar.php?erro=Erro ao cadastrar usuario.");  
       exit();
    }
    $usuario_id = $usuario->getId();
    }else{
        $usuario_id = $usuarioBanco->getId();
    }


    //verificar se o cliente existe
    $cliente = new Cliente();
    if($cliente->buscarPorUsuario($usuario_id)==false){
        //gravamos o cliente
        $cliente->setUsuario_Id($usuario_id);
        $cliente->setTelefone($telefone);
        $cliente->setCpf($cpf);
        if(!$cliente->Inserir()){
            header("location: contratar.php?erro=Erro ao cadastrar o Cliente.");  
            exit();
        }
    }

    $cliente_id = $cliente->getId();



?>