<?php
namespace Controller;

require_once '../Repository/LivroRepository.php';
require_once '../Model/Livro.php';
require_once '../Repository/AutorRespository.php';

use Repository\LivroRepository;
use Repository\AutorRepository;
use Model\Livro;
use Exception;

class LivroController {
    private LivroRepository $livroRepository;

    private AutorRepository $autorRepository;

    private string $mensagem = '';

    public function __construct() {
        $this->livroRepository = new LivroRepository();
        $this->autorRepository = new AutorRepository();
    }

    public function CadastrarLivro(string $titulo, int $ano, string $nome_autor) {
        try{
            $id_autor = $this->autorRepository->getAutorId($nome_autor);
            $this->livroRepository->cadastrarLivro($titulo, $ano, $id_autor);
            $this->mensagem = "Livro cadastrado com sucesso!";
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function ExcluirLivro(int $id) {
        try{
            $this->livroRepository->deletarLivro($id);
            $this->mensagem = "Livro deletado com sucesso!";
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
    }

    public function ListarLivros() {
        try{
            return $this->livroRepository->listar_livros();
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function EditarLivro(string $titulo, int $ano, string $autor,string $titulo_antigo) {
        try{
            $id_autor = $this->autorRepository->getAutorId($autor);
            $id_livro = $this->livroRepository->getLivroId($titulo_antigo);
            $livro = new Livro($titulo, $ano, $id_autor,false,$id_livro);
            $this->livroRepository->editarLivro($livro);
            $this->mensagem = "Livro deletado com sucesso!";
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function getMensage(){
        return $this->mensagem;
    }

    // Busca informações de um livro pelo seu ID
    public function getLivroById(int $id){
        try{
            return $this->livroRepository->findById($id);
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
        
    }

}

?>