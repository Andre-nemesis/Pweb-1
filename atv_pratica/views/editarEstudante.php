<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;


$controller = new EstudanteController();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $estudante = $controller->getEstudanteById($id);
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nome_antigo = $_GET['nome_antigo'];
    $controller->EditarEstudante($nome,$nome_antigo);
    header('Location: listarEstudantes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudante</title>
    <?php include 'menu.php'; ?>
</head>
<body>
    <h1>Editar Estudante</h1>
    <a href="listarEstudantes.php">Voltar para a lista</a>
    <form action=<?php echo "'editarEstudante.php?nome_antigo=".$estudante->getNome()."'"?> method="post">
        <label for="nome_antigo">Nome Antigo:</label>
        <input type="text" id="nome_antigo" disabled name="nome_antigo" value="<?php echo htmlspecialchars($estudante->getNome()); ?>" required>    
        <br>
        <label for="nome">Novo Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <input type="submit" value="Atualizar">
    </form>

</body>
</html>
