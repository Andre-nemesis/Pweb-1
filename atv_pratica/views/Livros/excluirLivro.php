<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../Controller/LivroController.php';
use Controller\LivroController;

$id = $_GET['id'];

// Cria uma instância do controlador com a conexão
$controller = new LivroController();
$controller->ExcluirLivro($id);
header('Location: listarLivros.php');
exit;
?>
