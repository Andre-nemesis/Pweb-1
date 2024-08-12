<?php

class Pessoa {
    private string $nome;
    private string $cpf;

    public function __construct(string $nome, string $cpf){
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getCpf(): string {
        return $this->cpf;
    }

    public function setNome(string $nome){
        $this->nome = $nome;
    }

    public function setCpf(string $cpf){
        $this->cpf = $cpf;
    }

}
?>