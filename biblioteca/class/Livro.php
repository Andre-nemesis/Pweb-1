<?php

namespace Biblioteca\Class;

class Livro{
    private string $titulo;
    private int $ano;
    private string $autor;

    private bool $status;

    public function __construct(string $titulo, int $ano, string $autor){
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->autor = $autor;
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

    public function setTitulo(string $titulo){
        $this->titulo = $titulo;
    }

    public function setAno(int $ano){
        $this->ano = $ano;
    }

    public function setAutor(string $autor){
        $this->autor = $autor;
    }

    public function setStatus(bool $status){
        $this->status = $status;
    }
}
?>