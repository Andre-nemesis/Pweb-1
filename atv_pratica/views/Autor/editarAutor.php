<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../Controller/AutorController.php';
use Controller\AutorController;


$controller = new AutorController();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $autor = $controller->getAutorById($id);
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $controller->EditarAutor($nome, $nacionalidade);
    header('Location: listarAutores.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Editar Autor</title>
    <?php include '../Head_Footer/menu.php'; ?>
</head>
<body>
    <div class="container">
        <section>
            <div>
                <h1 class="titulo-form-editarAutor">Editar Autor</h1>
            </div>
            <div>
                <img src="../imgs/edit.svg" style="margin-left: 4.5rem;">
            </div>
        </section>

        <div>
            <form action="editarAutor.php" method="post">
                <label class="form-group" for="nome">NOME:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($autor->getNome()); ?>" required>
                <br>
                <label class="form-group" for="nacionalidade">NACIONALIDADE:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" value="<?php echo htmlspecialchars($autor->getNacionalidade()); ?>" required>
                <br>
                <input type="submit" value="Atualizar">
            </form>
        </div>
    </div>

    <?php include '../Head_Footer/footer.php'; ?>

</body>
</html>
