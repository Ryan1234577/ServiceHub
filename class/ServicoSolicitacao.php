<? 
include_once "config/conexao.php";


 class ServicoSolicitacao
 { 
    private $servico_id;
    private $solicitacao_id;
    private $data_assoc;
    private $pdo;

    public function __construct()
    {
    $this->pdo = obterPdo(); 
    }
 }

?>