<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

// Cria uma instância do controlador com a conexão
$controller = new AutorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $controller->cadastrarAutor($nome, $nacionalidade);
    header('Location: listarAutores.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Autor</title>
    <?php include 'menu.php'; ?>
</head>
<body>
    <div class="container">
        <section>
        <div>
            <h1 class="titulo-form-autor">Cadastrar Novo Autor</h1>
        </div>
        <div>
            <img class="img-estudante" src="../views/imgs/" alt="">
        </div>
        </section>
            
        <div>
            <form action="cadastrarAutor.php" method="post">
                <label class="form-group" for="nome">NOME:</label>
                <input type="text" id="nome" name="nome" required>
                <br>
                <label class="form-group" for="nacionalidade">NACIONALIDADE:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" required>
                <br>
                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </div>
        
    <?php if (isset($controller)) : ?>
        <div class="mensagem"><?php echo $controller->getMensage(); ?></div>
    <?php endif; ?>
</body>
</html>
