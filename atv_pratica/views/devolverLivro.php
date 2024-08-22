<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
include_once '../Controller/BibliotecaController.php';
use Controller\LivroController;
use Controller\BibliotecaController;

// Cria uma instância do controlador com a conexão
$controller_livro = new LivroController();
$controller_biblioteca = new BibliotecaController();

$livros = $controller_livro->ListarLivros();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro = $_POST['livro'];
    $data_emprestimo = $_POST['data_devolucao'];
    $controller_biblioteca->devolverLivro($livro, $data_emprestimo);
    
    header('Location: gerarRelatorio.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/css/style.css">
    <title>Devolução de Livros</title>
    <?php include 'menu.php'; ?>
</head>
<body>
    <div class="container">
        <section>
            <div>
                <h1 class="titulo-form-devolverLivro">Cadastrar Nova Devolução</h1>
            </div>
            <div>
                <img src="../views/imgs/" alt="">
            </div>
        </section>

        <div>
            <form action="devolverLivro.php" method="post">
                <label class="form-group" for="livro">ESCOLHA UM LIVRO:</label>
                    <select name="livro" id="livro" required>
                        <?php foreach ($livros as $livro): ?>
                            <option value="<?php echo $livro->getTitulo(); ?>">
                                <?php echo $livro->getTitulo(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <br>
                <label class="form-group" for="data_devolucao">DATA DE DEVOLUÇÃO:</label>
                <input type="date" id="data_devolucao" name="data_devolucao" required>
                <br>
                
                <input type="submit" value="Cadastrar Devolução">
            </form>
        </div>
    </div>

    <?php if (isset($controller_livro)) : ?>
        <div class="mensagem"><?php echo $controller_biblioteca->getMensage(); ?></div>
    <?php endif; ?>
</body>
</html>
