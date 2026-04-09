<?php
$host = '10.91.47.51';
$db   = 'servicehubdb01'; // nome do meu banco de dados
$user = 'root';
$pass = 'P@ssword';
//php.net 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conectado com sucesso!!!";
    //var_dump($pdo);
} catch (PDOException $e) {
    //var_dump($e->getMessage());
    die("Erro na conexão: " . $e->getMessage());
}
