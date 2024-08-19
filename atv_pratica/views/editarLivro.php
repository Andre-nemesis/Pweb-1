<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
require_once '../Controller/AutorController.php';
use Controller\LivroController;
use Controller\AutorController;

$autor_controller = new AutorController();
$autores = $autor_controller->ListarAutores();
$controller = new LivroController();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $livro = $controller->getLivroById($id);
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $autor_nome = $_POST['autor'];
    $livro_titulo_antigo = $_GET['titulo_antigo'];
    $controller->EditarLivro($titulo,$ano,$autor_nome,$livro_titulo_antigo);
    header('Location: listarLivros.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <a href="listarLivros.php">Voltar para a lista</a>
    <form  action=<?php echo"'editarLivro.php?titulo_antigo=".$livro->getTitulo()."'"?>method="post">
        <h3>Novas informações</h3>
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>" required>
        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" value="<?php echo htmlspecialchars($livro->getAno()); ?>" required>
        <label for="autor">Escolha um autor:</label>
        <select name="autor" id="autor" required >
            <?php foreach ($autores as $autor): ?>
                <option value="<?php echo $autor->getNome(); ?>">
                    <?php echo $autor->getNome(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Atualizar">
    </form>

</body>
</html>
