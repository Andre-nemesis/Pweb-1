<?php
namespace Model;

use Exception;

class Relatorio{
    /**
     * Classe de Relatório de Livros
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
    private string $titulo_livro;

    private string $nome_estudante;

    private string $data_emprestimo;

    private string $data_devolucao;

    public function __construct(string $nome_estudante, string $titulo_livro, 
                                string $data_emprestimo, string $data_devolucao){
        try{
            if(is_string($nome_estudante) and is_string($titulo_livro) 
            and is_string($data_devolucao) and is_string($data_emprestimo)){
                $this->titulo_livro = $titulo_livro;
                $this->nome_estudante = $nome_estudante;
                $this->data_emprestimo = $data_emprestimo;
                $this->data_devolucao = $data_devolucao;
            }

            else{
                throw new Exception('Invalid arguments into has inserted into Biblioteca');
            }
        }

        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function getNomeEstudante(): string{
        return $this->nome_estudante;
    }

    public function getTituloLivro(): string{
        return $this->titulo_livro;
    }

    public function getDataEmprestimo():string{
        return $this->data_emprestimo;
    }

    public function getDataDevolucao():string{
        return $this->data_devolucao;
    }

}
?>