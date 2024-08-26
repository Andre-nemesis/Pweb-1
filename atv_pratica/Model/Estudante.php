<?php 

namespace Model;
use Exception;
class Estudante{
    /**
     * Classe de Estudante
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
    private string $nome;

    private int $id;

    public function __construct($name, $id=0){
        try{
            if (is_null($name) and is_integer($id)){
                throw new Exception("Nome and Id needs to be a string and a integer.");
            }
            else{
                $this->nome = $name;
                $this->id = $id;
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
        return $this->nome;
    }

    public function setNome($nome): string{
        return $this->nome = $nome;
    }
}
?>