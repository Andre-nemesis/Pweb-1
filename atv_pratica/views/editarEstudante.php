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
    <link rel="stylesheet" href="../views/css/style.css">
    <title>Editar Estudante</title>
    <?php include 'menu.php'; ?>
</head>
<body>
    <div class="container">
        <section>
            <div>
                <h1 class="titulo-form-editarEstudante">Editar Estudante</h1>
            </div>
            <div>
                <img src="../views/imgs/book-open-svgrepo-com (1).svg" alt="">
            </div>
        </section>

        <div>
            <form action=<?php echo "'editarEstudante.php?nome_antigo=".$estudante->getNome()."'"?> method="post">
                <label for="nome_antigo">NOME ANTIGO:</label>
                <input type="text" id="nome_antigo" disabled name="nome_antigo" value="<?php echo htmlspecialchars($estudante->getNome()); ?>" required>    
                <br>
                <label for="nome">NOVO NOME:</label>
                <input type="text" id="nome" name="nome" required>
                <br>
                <input type="submit" value="Atualizar">
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
