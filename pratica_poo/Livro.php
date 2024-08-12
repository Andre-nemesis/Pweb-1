<?php

class Livro{
    private string $titulo;
    private int $ano;
    private string $autor;

    public function __construct(string $titulo , int $ano, string $autor){
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

}
?>