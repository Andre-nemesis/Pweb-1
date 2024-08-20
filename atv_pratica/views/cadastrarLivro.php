<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
include_once '../Controller/AutorController.php';
use Controller\LivroController;
use Controller\AutorController;

// Cria uma instância do controlador com a conexão
$controller_livro = new LivroController();
$controller_autor = new AutorController();
$autores = $controller_autor->ListarAutores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $autor_nome = $_POST['autor'];
    $controller_livro->CadastrarLivro($titulo, $ano,$autor_nome);
    header('Location: listarLivros.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
</head>
<body>
    <h1>Cadastrar Novo Livro</h1>
    
    <a href="index.php">Voltar para a página inicial</a>
    <form action="cadastrarLivro.php" method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br>
        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" required>
        <br>
        <label for="autor">Escolha um autor:</label>
        <select name="autor" id="autor" required>
            <?php foreach ($autores as $autor): ?>
                <option value="<?php echo $autor->getNome(); ?>">
                    <?php echo $autor->getNome(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
    <?php if (isset($controller_livro)) : ?>
        <div class="mensagem"><?php echo $controller_livro->getMensage(); ?></div>
    <?php endif; ?>
</body>
</html>