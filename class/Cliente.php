<?php
// Importando conexão
include_once "config/conexao.php";
 
 
// declarar classe
// A classe representa a estrutura lógica de um usuário | Tudo que um usuário possui e faz
class Cliente
{
    //atributos = Estado do Objeto
    // Informações internas do usuário
    private $id;
    private $usuario_id;
    private $telefone;
    private $cpf;
    private $pdo;

    public function __construct()
    {
        $this->pdo = obterPdo(); //quando utilizar  
        // A classe precisa acessar o banco, em vez de abrir a conexão toda hora, ela já guarda a função  
    }



    // GET = pegar valor
    // SET = definir valor

    //ID
    public function getId()
    {
        return $this->id;
    }
 
        public function setId(int $id)
    {
        $this->id = $id;
    }
    //usuario_id
    public function getUsuario_Id()
    {
        return $this->usuario_id;
    }
    public function setUsuario_Id(int $usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
    //telefone
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone(int $telefone)
    {
       $this->telefone = $telefone; 
    }
    //cpf
    public function getcpf()
    {
        return $this->cpf;
    }
    public function setcpf(int $cpf)
    {
        $this->cpf = $cpf;
    }


    //metodo inserir
    public function inserir():bool
    {
        $sql = "INSERT clientes (usuario_id, telefone, cpf) VALUES (:usuario_id, :telefone, :cpf)"; // : Váriavel SQL
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":usuario_id", $this->usuario_id, PDO::PARAM_INT);
        $cmd->bindValue(":telefone", $this->telefone, PDO::PARAM_STR);
        $cmd->bindValue(":cpf", $this->cpf, PDO::PARAM_STR);
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    //metodo atualizar
    public function atualizar():bool{
        if(!$this->id) return false;
        $sql = "UPDATE clientes SET usuario_id = :usario_id, telefone = :telefone, cpf = :cpf WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd ->bindValue(":usuario_id", $this->usuario_id, PDO::PARAM_INT);
        $cmd ->bindValue(":telefone", $this->telefone, PDO::PARAM_STR);
        $cmd ->bindValue(":cpf", $this->cpf, PDO::PARAM_STR);
        $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
        return $cmd->execute();
    }

    //metodo listar
       public static function listar(): array
    {
        $cmd = obterPdo()->query("SELECT * FROM clientes ORDER BY id");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    //metodo listarAtivos
     public static function listarAtivos(): array
    {
        $cmd = obterPdo()->query("SELECT * FROM clientes WHERE ativo = 1 ORDER BY id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }


    //metodo buscarPorId
    public function buscarPorId(int $id):bool
    {
        $sql = "SELECT * FROM clientes WHERE id=:id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        $this->setId($dados['id']);
        $this->setUsuario_Id($dados['usuario_id']);
        $this->setTelefone($dados['telefone']);
        $this->setcpf($dados['cpf']);
        return true;
    }
        return false;
    }

    //metodo buscarPorUsuario
    public function buscarPorUsuario(int $usuario_id):bool
    {
        $sql = "SELECT * FROM clientes WHERE usuario_id=:usuario_id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":usuario_id",$usuario_id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        $this->setUsuario_Id($dados['usuario_id']);
        $this->setTelefone($dados['telefone']);
        $this->setcpf($dados['cpf']);
        return true;
    }
        return false;
    }

}


    ?>