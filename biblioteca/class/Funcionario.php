<?php

namespace Biblioteca\Class;

use Biblioteca\Class\Pessoa;
use Biblioteca\Class\Livro;
use Biblioteca\Class\OperacoesUsuario;
use Exception;

class Funcionario extends Pessoa implements OperacoesUsuario{
    private int $idFuncionario;
    private string $cargo;

    private string $senha;

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

    public function getSenha():string{
        return $this->senha ?? "";
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

    public function login():bool{
        return true; // será implementado posteriormente
    }

    public function logout(): bool{
        return false; // será implementado posteriorment
    }

}
?>