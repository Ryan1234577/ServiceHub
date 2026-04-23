<? 
include_once "config/conexao.php";

class Servico
{
    private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $descontinuado;
    private $pdo;

    public function __construct()
    {
        $this->pdo = obterPdo();
    }

    public function getId()
    {
        return $this->id;
    }
 
        public function setId(int $id)
    {
        $this->id = $id;
    }


    public function getNome()
    {
        return $this->nome;
    }
 
        public function setNome(string $nome)
    {
        $this->id = $nome;
    }


    public function getPreco()
    {
        return $this->preco;
    }
 
        public function setPreco(float $preco)
    {
        $this->preco = $preco;
    }


    public function getDescontinuado()
    {
        return $this->descontinuado;
    }
 
        public function setDescontinuado(bool $descontinuado)
    {
        $this->descontinuado = $descontinuado;
    }


     public function getDescricao()
    {
        return $this->descricao;
    }
 
        public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }




    //metodo inserir
    public function inserir():bool
    {
        $sql = "INSERT servicos (nome, descricao, preco, descontinuado) VALUES (:nome, :descricao, :preco, :descontinuado)"; // : Váriavel SQL
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome, PDO::PARAM_STR);
        $cmd->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
        $cmd->bindValue(":preco", $this->preco, PDO::PARAM_STR);
        $cmd->bindValue(":descontinuado", $this->descontinuado, PDO::PARAM_BOOL);
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    //metodo atualizar
       public function atualizar():bool{
        if(!$this->id) return false;
        $sql = "UPDATE servicos SET nome = :nome, descricao = :descricao, preco = :preco, descontinuado = :descontinuado WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd ->bindValue(":nome", $this->nome, PDO::PARAM_STR);
        $cmd ->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
        $cmd ->bindValue(":preco", $this->preco, PDO::PARAM_STR);
        $cmd->bindValue(":descontinuado", $this->descontinuado, PDO::PARAM_BOOL);
        return $cmd->execute();
    }
    
    //metodo listar
       public static function listar(): array
    {
        $cmd = obterPdo()->query("SELECT * FROM servicos ORDER BY id");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

     //metodo listarAtivos
     public static function listarAtivos(): array
    {
        $cmd = obterPdo()->query("SELECT * FROM servicos WHERE ativo = 1 ORDER BY id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    //metodo buscarPorId
    public function buscarPorId(int $id):bool
    {
        $sql = "SELECT * FROM servicos WHERE id=:id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        $this->setId($dados['id']);
        $this->setNome($dados['nome']);
        $this->setDescricao($dados['descricao']);
        $this->setPreco($dados['preco']);
        $this->setDescontinuado($dados['descontinuado']);
        return true;
    }
        return false;
    }


 //metodo excluir

public function excluir(int $id): bool {
    if (!$this->id) return false;
 
    $sql = "DELETE FROM servicos WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
 
    return $cmd->execute();
}

}