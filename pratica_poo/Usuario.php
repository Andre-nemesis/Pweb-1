<?php

require_once 'Pessoa.php';
require_once 'InterfaceUsuario.php';
require_once 'Livro.php';

class Usuario extends Pessoa implements OperacoesUsuario{
    private int $idUsuario;
    private string $senha;

    private array $livros_emprestados;

    public function __construct(string $nome,string $cpf,int $id,string $senha){
        parent::__construct($nome, $cpf);
        $this->idUsuario = $id;
        $this->senha = $senha;
    }

    public function login(): bool{
        return true;
    }

    public function logout(): bool{
        return false;
    }

    public function trocarSenha(string $antigaSenha, string $novaSenha):bool{
        try{
            if ($this->senha == $antigaSenha){
                $this->senha = $novaSenha;
                return true;
            }
            else return false;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function pegarLivro(Livro $livro):bool{
        try{
            array_push($this->livros_emprestados,$livro);
            return true;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function devolverLivro(Livro $livro):bool{
        try{
            $indice = array_search($livro,$this->livros_emprestados);
            if (is_numeric($indice)){
                unset($this->livros_emprestados[$indice]);
                return true;
            }
            else return false;
            
            
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>