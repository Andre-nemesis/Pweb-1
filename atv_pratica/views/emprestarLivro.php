<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
include_once '../Controller/EstudanteController.php';
include_once '../Controller/BibliotecaController.php';
use Controller\LivroController;
use Controller\EstudanteController;
use Controller\BibliotecaController;

// Cria uma instância do controlador com a conexão
$controller_livro = new LivroController();
$controller_estudante = new EstudanteController();
$controller_biblioteca = new BibliotecaController();

$livros = $controller_livro->ListarLivros();
$estudantes = $controller_estudante->ListarEstudantes();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estudante = $_POST['estudante'];
    $livro = $_POST['livro'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $controller_biblioteca->emprestarLivro($estudante, $livro, $data_emprestimo);
    header('Location: gerarRelatorio.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestimo de Livros</title>
</head>
<body>
    <h1>Cadastrar Novo Emprestimo</h1>
    
    <a href="index.php">Voltar para a página inicial</a>
    <form action="emprestarLivro.php" method="post">
        <label for="estudante">Escolha um estudante:</label>
            <select name="estudante" id="estudante" required>
                <?php foreach ($estudantes as $estudante): ?>
                    <option value="<?php echo $estudante->getNome(); ?>">
                        <?php echo $estudante->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <label for="livro">Escolha um Livro:</label>
            <select name="livro" id="livro" required>
                <?php foreach ($livros as $livro): ?>
                    <option value="<?php echo $livro->getTitulo(); ?>">
                        <?php echo $livro->getTitulo(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <br>
        <label for="data_emprestimo">Data de Emprestimo:</label>
        <input type="date" id="data_emprestimo" name="data_emprestimo" required>
        <br>
        
        <input type="submit" value="Cadastrar Emprestimo">
    </form>
    <?php if (isset($controller_livro)) : ?>
        <div class="mensagem"><?php echo $controller_biblioteca->getMensage(); ?></div>
    <?php endif; ?>
</body>
</html>
