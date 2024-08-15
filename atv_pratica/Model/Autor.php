<?php

namespace Model;

use Exception;


class Autor{
    private int $idAutor;

    private string $nome;

    private string $nacionalidade;

    public function __construct(int $id, string $nome, string $nacionalidade){
        try{
            if (is_string($nome) and is_string($nacionalidade) and is_numeric($id)){
                $this->nome = $nome;
                $this->idAutor = $id;
                $this->nacionalidade = $nacionalidade;
            }
            else{
                throw new Exception("The parameter of the Autor needs to be string and integer.");
            }
        }

        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function getIdAutor(): int{
        return $this->idAutor;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function getNacionalidade(): string{
        return $this->nacionalidade;
    }

    public function setId(int $id){
        $this->idAutor=$id;
    }

    public function setNacionalidade($nacionalidade) {
        return $this->nacionalidade = $nacionalidade;
    }

    public function setNome($nome) {
        return $this->nome = $nome;
    }

    
}