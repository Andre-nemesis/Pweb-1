<?php
namespace Controller;

require_once '../Repository/AutorRespository.php';
require_once '../Model/Autor.php';
use Repository\AutorRepository;
use Model\Autor;
use Exception;

class AutorController {
    private AutorRepository $autorRepository;

    private string $mensagem = '';
    public function __construct() {
        $this->autorRepository = new AutorRepository();
    }

    // Métodos para cada ação e método HTTP
    public function CadastrarAutor(string $nome, string $nacionalidade) {
        try{
            // Cria um novo objeto Autor
            $autor = new Autor(0,$nome,$nacionalidade);
            $this->autorRepository->cadastrarAutor($autor);
            // Mensagem de sucesso
            $this->mensagem = "autor cadastrado com sucesso!";
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    
    }

    public function ExcluirAutor(string $nome){

        // Cria um novo objeto Autor Reposiotry
        $this->autorRepository->deletarAutor($nome);

        // Mensagem de sucesso
        $this->mensagem = "autor deletado com sucesso!";
    }

    public function ListarAutores(){
        // Cria um novo objeto Autor Reposiotry
        return $this->autorRepository->listar_autores();
    }

    public function EditarAutor(string $nome, string $nacionalidade){
    
        // Cria um novo objeto Autor Reposiotry
        $autor = new Autor(0,$nome,$nacionalidade);
        $this->autorRepository->editarAutor($autor);
    
        // Mensagem de sucesso
        $this->mensagem = "autor editado com sucesso!";
    }

    public function getMensage(){
        return $this->mensagem;
    }

    public function getAutorById(int $id){
        return $this->autorRepository->findById($id);
    }
    
}

?>