<?php 

require_once 'LivroHandler.php';
require_once 'Estudante.php';
class BibliotecaHander{
    private array $livros;

    public function emprestarLivro(LivroHandler $livro,Estudante $estudante):bool{
        // implementar dps
        return true;
    }

    public function devolverLivro(LivroHandler $livro,Estudante $estudante):bool{
        // implementar dps
        return true;
    }

    public function livrosEsmprestados(LivroHandler $livro,Estudante $estudante):array{
        return [];
    }
}
?>