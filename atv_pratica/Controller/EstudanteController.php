<?php

namespace Controller;

require_once '../../Repository/EstudanteRepository.php';
require_once '../../Model/Estudante.php';
use Repository\EstudanteRepository;
use Model\Estudante;
use Exception;

class EstudanteController {
    /**
     * Classe de EstudanteController
     * Classe referente a gestão do repositório do estudante.
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
    private EstudanteRepository $estudanteRepository;

    private string $mensagem = '';
    public function __construct(){
        $this->estudanteRepository = new EstudanteRepository();
    }

    public function CadastrarEstudante(string $nome){
        try{
            $estudante = new Estudante($nome);
            $this->estudanteRepository->CadastrarEstudante($estudante);
            $this->mensagem = "Estudante cadastrado com sucesso!";
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
    }

    public function ExcluirEstudante(int $id){
        try{
            $this->estudanteRepository->deletarEstudante($id);
            $this->mensagem = "Estudante deletado com sucesso!";
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
        
    }

    public function ListarEstudantes(){
        
        return $this->estudanteRepository->listar_estudantes();
    }

    public function EditarEstudante(string $nome, string $nome_antigo){
        try{
            $estudante = new Estudante($nome);
            $this->estudanteRepository->editarEstudante($estudante,$nome_antigo);
            $this->mensagem = "Estudante editado com sucesso!";
        }
        
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
    }

    public function getMensage(){
        return $this->mensagem;
    }

    // Busca informações de um estudante pelo seu ID
    public function getEstudanteById(int $id){
        try{
            return $this->estudanteRepository->findById($id);
        }
        catch(Exception $e){
            $this->mensagem = $e->getMessage();
        }
    }
}

?>