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
</head>
<body>
    <header class="menu">
        <nav>
            <ul>
                <img src="../views/imgs/book-open-svgrepo-com.svg">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="dropdown">
                    <a href="">Livros</a>
                    <div class="dropdown-menu">
                        <a href="cadastrarLivro.php">Cadastar Livro</a>
                        <a href="editarLivro.php">Editar Livro</a>
                        <a href="excluirLivros.php">Excluir Livro</a>
                        <a href="listarLivros.php">Listar Livros</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="">Autores</a>

                    <div class="dropdown-menu">
                        <a href="cadastrarAutor.php">Cadastar Autor</a>
                        <a href="editarAutor.php">Editar Autor</a>
                        <a href="excluirAutor.php">Excluir Autor</a>
                        <a href="listarAutor.php">Listar Autores</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="">Estudantes</a>
                    <div class="dropdown-menu">
                        <a href="cadastrarEstudante.php">Cadastar Estudante</a>
                        <a href="editarEstudantes.php">Editar Estudante</a>
                        <a href="excluirEstudantes.php">Excluir Estudante</a>
                        <a href="listarEstudantes.php">Listar Estudantes</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="">Emprestimos</a>
                    <div class="dropdown-menu">
                        <a href="emprestarLivro.php">Reservar Livro</a>
                        <a href="devolverLivro.php">Devolver Livro</a>
                        <a href="gerarRelatorio.php">Gerar Relatório</a>
                    </div>
                </li>
            </ul>
        </nav>
        
    </header>
    
</body>
</html>