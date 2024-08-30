<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../Controller/LivroController.php';
include_once '../../Controller/AutorController.php';
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastrar Livro</title>
    <?php include '../Head_Footer/menu.php'; ?>
</head>
<body>
    <div class="container">
        <section>
            <div>
                <h1 class="titulo-form">Cadastrar Novo Livro</h1>
            </div>
            <div>
                <img src="../imgs/book.svg" alt="">
            </div>
        </section>
        
        <div>
            <form action="cadastrarLivro.php" method="post">
                <label class="form-group" for="titulo">TÍTULO:</label>
                <input type="text" id="titulo" name="titulo" required>
                <br>
                <label class="form-group" for="ano">ANO:</label>
                <input type="number" id="ano" name="ano" required>
                <br>
                <label class="form-group" for="autor">ESCOLHA UM AUTOR:</label>
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

        </div>
    </div>

    <?php include '../Head_Footer/footer.php'; ?>
</body>
</html>
