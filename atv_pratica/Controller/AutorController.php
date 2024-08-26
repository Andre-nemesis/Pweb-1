<?php
namespace Controller;

require_once '../Repository/AutorRespository.php';
require_once '../Model/Autor.php';
use Repository\AutorRepository;
use Model\Autor;
use Exception;

class AutorController {
     /**
     * Classe de AutorController
     * Classe referente ao controle do repositório na inserção de dados
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
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
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function ExcluirAutor(int $id){
        try{
            // Cria um novo objeto Autor Reposiotry
            $this->autorRepository->deletarAutor($id);

            // Mensagem de sucesso
            $this->mensagem = "autor deletado com sucesso!";
        }
        catch(Exception $e){
            // Mensagem de error
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function ListarAutores(){
        try{
            // Cria um novo objeto Autor Reposiotry
            return $this->autorRepository->listar_autores();
        }

        catch(Exception $e){
            // Mensagem de error
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function EditarAutor(string $nome, string $nacionalidade){
        try{
            // Cria um novo objeto Autor Reposiotry
            $autor = new Autor(0,$nome,$nacionalidade);
            $this->autorRepository->editarAutor($autor);
        
            // Mensagem de sucesso
            $this->mensagem = "autor editado com sucesso!";
        }
        catch(Exception $e){
            // Mensagem de error
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function getMensage(){
        return $this->mensagem;
    }

    public function getAutorById(int $id){
        try{
            return $this->autorRepository->findById($id);
        }
        catch(Exception $e){
            // Mensagem de error
            $this->mensagem = $e->getMessage();
        }
        
    }
    
}

?>