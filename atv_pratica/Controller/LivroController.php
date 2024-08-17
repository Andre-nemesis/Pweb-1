<?php
namespace Controller;

require_once '../Repository/LivroRespository.php';
require_once '../Model/Livro.php';
use Repository\LivroRepository;
use Model\Livro;
use Exception;

class LivroController {
    private LivroRepository $livroRepository;

    private string $mensagem = '';

    public function __construct() {
        $this->livroRepository = new LivroRepository();
    }

    public function CadastrarLivro(string $titulo, int $ano, int $id_autor) {
        try{
            $this->livroRepository->cadastrarLivro($titulo, $ano, $id_autor);
            $this->mensagem = "Livro cadastrado com sucesso!";
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function ExcluirLivro(string $titulo) {
        $this->livroRepository->deletarLivro($titulo);
        $this->mensagem = "Livro deletado com sucesso!";
    }

    public function ListarLivros() {
        return $this->livroRepository->listar_livros();
    }

    public function EditarLivro(string $titulo, int $ano, string $autor) {
        $livro = new Livro($titulo, $ano, $autor);
        $this->mensagem = "Livro deletado com sucesso!";
    }

    public function getMensage(){
        return $this->mensagem;
    }

    public function getLivroById(int $id){
        return $this->livroRepository->findById($id);
    }

}

?>