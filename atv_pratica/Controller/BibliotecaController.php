<?php 

namespace Controller;

require_once '../../Repository/BibliotecaRepository.php';

use Exception;
use Repository\BibliotecaRepository;

class BibliotecaController{
    /**
     * Classe de BibliotecaController
     * Classe referente a gestão da biblioteca, para emprestimo e devolução de livro e geração de relatório.
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
    private BibliotecaRepository $biblioteca_repository;

    // Armazenar mensagens de feedback
    private string $mensagem = '';

    public function __construct(){
        $this->biblioteca_repository = new BibliotecaRepository();
    }

    // Gerar um relatório dos livros emprestados
    public function gerarRelatorio(){
        try{
            $livros_emprestados = $this->biblioteca_repository->gerarRelatorio();
            $this->mensagem = 'Relatório gerado com sucesso';
            return $livros_emprestados;
        }
        catch (Exception $e){
            $this->mensagem = $e->getMessage();
        }
    }

    public function emprestarLivro(string $nome_estudante, string $titulo_livro, string $data_emprestimo){
        try{
            $this->biblioteca_repository->emprestarLivro($nome_estudante, $titulo_livro, $data_emprestimo);
            $this->mensagem = 'Livro emprestado com sucesso!';
        }
        catch (Exception $e){
            $this->mensagem = $e->getMessage();
        }

    }

    public function devolverLivro(string $titulo_livro, string $data_devolucao){
        try{
            $this->biblioteca_repository->devolverLivro($titulo_livro, $data_devolucao);
            $this->mensagem = 'Livro devolvido com sucesso!';
        }
        catch (Exception $e){
            $this->mensagem = $e->getMessage();
        }
    }

    public function getMensage(): string{
        return $this->mensagem;
    }
}
?>