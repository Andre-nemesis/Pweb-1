<?php

namespace Model;

use Exception;
use db\DBConectionHandler;
require_once './atv_pratica/db/DBConnectionHandler.php';

class Livro{
    private int $idLivro;
    private string $titulo;
    private int $ano;
    private int $autor;

    private bool $status;

    public function __construct(int $id_livro,string $titulo, int $ano, int $autor, bool $status = true){
        try{
            if (is_string($titulo) and is_integer($autor) and is_integer($ano) and is_integer($id_livro) and is_bool($status)){
                $this->titulo = $titulo;
                $this->autor = $autor;
                $this->ano = $ano;
                $this->status = $status;
                $this->idLivro = $id_livro;
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

    public function getStatus(): bool{
        return $this->status;
    }

}
?>