<?php

namespace Biblioteca\Class;

use Biblioteca\Class\Pessoa;
use Biblioteca\Class\Livro;
use Exception;

class Funcionario extends Pessoa{
    private int $idFuncionario;
    private string $cargo;

    public function __construct(string $nome, string $cpf,int $idFuncionario,string $cargo){
        parent::__construct($nome, $cpf);
        $this->idFuncionario = $idFuncionario;
        $this->cargo = $cargo;
    }
    public function getIdFuncionario(): int{
        return $this->idFuncionario;
    }

    public function getCodigoFuncionario(): string{
        return $this->cargo;
    }

    public function cadastrarLivro(Livro $livro):bool{
        try{
            if (is_null($livro->getAutor())){
                return false;
            }
            else return true;
        }
        catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function removerLivro(Livro $livro):bool{
        try{
            unset($livro);
            return true;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

}
?>