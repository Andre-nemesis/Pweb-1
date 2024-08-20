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
                        <a href="editarLivros.php">Editar Livro</a>
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
                        <a href="listarEstudantes.php">Listar Autores</a>
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
                    <h1>jorge</h1>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
    <p>Todos os direitos reservardo para os criadores</p>
    <h5>Criadores</h5>
    <p>André Casimiro da Silva</p>
    <p>Francisca Geovanna de Lima da Silva</p>
    <p>IFCE CAMPUS CEDRO 2024</p>
    </footer>
</body>
</html>