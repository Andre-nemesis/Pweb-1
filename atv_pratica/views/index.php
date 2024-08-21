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
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="../views/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <?php include 'menu.php'; ?>
</head>
<body>
    
    
    <main>
        <section class="centro">
            <div class="centro_centro">
                <div class="centro_centro_dir">
                    <h1>Bem vindo(a)!</h1>
                    <p>Nossa biblioteca é um espaço dedicado ao conhecimento e à leitura, onde você pode explorar um vasto
                        acervo de livros, conhecer autores renomados e registrar estudantes que compartilham o amor pela
                        leitura. Com nosso sistema de gestão, você pode facilmente cadastrar novos títulos, gerenciar
                        autores e pegar emprestado o livro que quiser. Navegue pelo nosso acervo e descubra tudo o que a
                        nossa biblioteca tem a oferecer!</p>
                </div>
                <div class="centro_centro_esq">
                    <img src="../views/imgs/livros.png" alt="">
                </div>
            </div>
        </section>

        <section class="emprestimo_livro" id="emprestimo">
            <h1>Cadastrar Novo Emprestimo</h1>
            <br>
            <form action="index.php" method="post">
                <label for="estudante">Escolha um estudante:</label>
                    <select name="estudante" id="estudante" required>
                        <?php foreach ($estudantes as $estudante): ?>
                            <option value="<?php echo $estudante->getNome(); ?>">
                                <?php echo $estudante->getNome(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <br>
                <br>
                <label for="livro">Escolha um Livro:</label>
                    <select name="livro" id="livro" required>
                        <?php foreach ($livros as $livro): ?>
                            <option value="<?php echo $livro->getTitulo(); ?>">
                                <?php echo $livro->getTitulo(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <br>
                <br>
                <label for="data_emprestimo">Data de Emprestimo:</label>
                <br>
                <input type="date" id="data_emprestimo" name="data_emprestimo" required>
                <br>
                <br>
                <input type="submit" value="Cadastrar Emprestimo">
            </form>
            <?php if (isset($controller)) : ?>
                <div class="mensagem"><?php echo $controller->getMensage(); ?></div>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>