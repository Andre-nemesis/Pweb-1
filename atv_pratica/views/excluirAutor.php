<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

$id = $_GET['id'];

// Cria uma instância do controlador com a conexão
$controller = new AutorController();
$controller->ExcluirAutor($id);
header('Location: listarAutores.php');
exit;
?>
