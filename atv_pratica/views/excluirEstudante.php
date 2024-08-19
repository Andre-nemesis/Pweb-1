<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

$id = $_GET['id'];

// Cria uma instância do controlador com a conexão
$controller = new EstudanteController();
$controller->ExcluirEstudante($id);
header('Location: listarEstudantes.php');
exit;
?>
