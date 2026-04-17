<?php
session_start(); 
include "includes/header.php";
include "includes/menu.php";

if(!isset($_SESSION['usuario_id']) || $_SESSION["tipo"] != 2){ //isset função que retorna boll para variavel existente e valor atribuido
   header("location: login.php");                              // "!" inverte isset (caso não tenha valor ou a variavel ele retorna true)
} 
                                                              
?>
<main class="container mt-5">
  <h2>Bem-vindo, <strong><?= $_SESSION['nome'] ?></strong></h2>
  <p><a href="logout.php" class="btn btn-danger btn-sm">Sair</a></p>
  <a href="cliente_perfil.php" class="btn btn-warning btn-sm">Meu Perfil</a>
  <h4 class="mt-4">Minhas Solicitações</h4>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
   
          <td></td>
         
          <td></td>
          <td></td>
          <td>
            <a href="cliente_detalhes.php?id=" class="btn btn-primary btn-sm">Detalhes</a>
          </td>
        </tr>
    </tbody>
  </table>
</main>
<?php 
include "includes/footer.php";
?>