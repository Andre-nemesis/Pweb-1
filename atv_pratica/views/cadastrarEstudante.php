<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

// Cria uma instância do controlador com a conexão
$controller = new EstudanteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $controller->CadastrarEstudante($nome);
    header('Location: listarEstudantes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Estudante</title>
    <?php include 'menu.php'; ?>
</head>
<body>
    <h1>Cadastrar Novo Estudante</h1>
    
    <a href="index.php">Voltar para a página inicial</a>
    <form action="cadastrarEstudante.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
    <?php if (isset($controller)) : ?>
        <div class="mensagem"><?php echo $controller->getMensage(); ?></div>
    <?php endif; ?>
</body>
</html>
