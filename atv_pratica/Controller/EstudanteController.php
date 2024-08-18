<?php

namespace Controller;

require_once '../Repository/EstudanteRespository.php';
require_once '../Model/Estudante.php';
use Repository\EstudanteRepository;
use Model\Estudante;
use Exception;

class EstudanteController {
    private EstudanteRepository $estudanteRepository;

    private string $mensagem = '';
    public function __construct(){
        $this->estudanteRepository = new EstudanteRepository();
    }

    public function CadastrarEstudante(string $nome, int $id){
        try{
            $estudante = new Estudante($nome, null);
            $this->estudanteRepository->CadastrarEstudante($estudante);
            $this->mensagem = "Estudante cadastrado com sucesso!";
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function ExcluirEstudante(string $nome){
        $this->estudanteRepository->deletarEstudante($nome);
        $this->mensagem = "Estudante deletado com sucesso!";
    }

    public function ListarEstudantes(){
        return $this->estudanteRepository->listar_estudantes();
    }

    public function EditarEstudante(string $nome){
        $estudante = new Estudante($nome);
        $this->estudanteRepository->editarEstudante($estudante);
        $this->mensagem = "Estudante editado com sucesso!";
    }

    public function getMensage(){
        return $this->mensagem;
    }

    public function getEstudanteById(int $id){
        return $this->estudanteRepository->findById($id);
    }
}

?>