<?php

namespace Model;
use Exception;
use DBConectionHandler;

require_once './atv_pratica/db/DBConnectionHandler.php';

class Autor{
    private int $idAutor;

    private string $nome;

    private string $nacionalidade;

    public function __construct(string $nome, string $nacionalidade){
        try{
            if (is_string($nome) and is_string($nacionalidade)){
                $this->nome = $nome;
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

    public function getNascionalidade(): string{
        return $this->nacionalidade;
    }

    public function setId(int $id){
        $this->idAutor=$id;
    }

    
}