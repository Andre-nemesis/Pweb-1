<?php

namespace Model;

use Exception;
use db\DBConectionHandler;
require_once './atv_pratica/db/DBConnectionHandler.php';

class Livro{
    private string $titulo;
    private int $ano;
    private int $autor;

    public function __construct(string $titulo , int $ano, int $autor){
        try{
            if (is_string($titulo) and is_integer($autor) and is_integer($ano)){
                $this->titulo = $titulo;
                $this->autor = $autor;
                $this->ano = $ano;
            }
            else{
                throw new Exception("The parameter of the function are not valid.");
            }
        }

        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function getTitulo(): string{
        return $this->titulo;
    }

    public function getAno(): int{
        return $this->ano;
    }

    public function getAutor(): string{
        return $this->autor;
    }

}
?>