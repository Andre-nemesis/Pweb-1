<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../imgs/library-icon.svg">
</head>
<body>
    <header class="menu">
        <nav>
            <ul>
                <img src="../imgs/library.svg">
                <li>
                    <a href="../Biblioteca/index.php">Home</a>
                </li>
                <li class="dropdown">
                    <a href="">Livros</a>
                    <div class="dropdown-menu">
                        <a href="../Livros/cadastrarLivro.php">Cadastar Livro</a>
                        <a href="../Livros/listarLivros.php">Editar Livro</a>
                        <a href="../Livros/listarLivros.php">Excluir Livro</a>
                        <a href="../Livros/listarLivros.php">Listar Livros</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="">Autores</a>

                    <div class="dropdown-menu">
                        <a href="../Autor/cadastrarAutor.php">Cadastar Autor</a>
                        <a href="../Autor/listarAutores.php">Editar Autor</a>
                        <a href="../Autor/listarAutores.php">Excluir Autor</a>
                        <a href="../Autor/listarAutores.php">Listar Autores</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="">Estudantes</a>
                    <div class="dropdown-menu">
                        <a href="../Estudante/cadastrarEstudante.php">Cadastar Estudante</a>
                        <a href="../Estudante/listarEstudantes.php">Editar Estudante</a>
                        <a href="../Estudante/listarEstudantes.php">Excluir Estudante</a>
                        <a href="../Estudante/listarEstudantes.php">Listar Estudantes</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="">Emprestimos</a>
                    <div class="dropdown-menu">
                        <a href="../Biblioteca/index.php#emprestimo">Reservar Livro</a>
                        <a href="../Biblioteca/devolverLivro.php">Devolver Livro</a>
                        <a href="../Biblioteca/gerarRelatorio.php">Gerar Relatório</a>
                    </div>
                </li>
            </ul>
        </nav>
        
    </header>
    
</body>
</html>