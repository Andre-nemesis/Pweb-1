<?php 

namespace Model;
use Exception;
class Estudante{
    private string $name;

    private int $id;

    public function __construct($name, $id=0){
        try{
            if (is_string($name) and is_int($id)){
                $this->name = $name;
                $this->id = $id;
            }
            else{
                throw new Exception("Nome and Id needs to be a string and a integer.");
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function getEstudanteId(): int{
        return $this->id;
    }

    public function getNome(): string{
        return $this->name;
    }

    public function setNome($nome): string{
        return $this->nome = $nome;
    }
}
?>