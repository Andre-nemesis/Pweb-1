<?php

include_once 'Livro.php';

class Biblioteca{
    private array $livros;
    private array $usuarios;

    public function __construct(){
    }

    public function addLivro(Livro $livro):void{
        try{
            array_push($this->livros, $livro);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function removerLivro(Livro $livro):void {
        try {
            $indice = array_search($livro, $this->livros);
            if ($indice !== false) {
                unset($this->livros[$indice]);
           }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function emprestarLivro(Livro $livro,Usuario $usuario):bool{
        try{
            $indice = array_search($livro,$this->livros);
            if(is_numeric($indice)){
                $usuario->pegarLivro($livro);
                $this->livros[$indice]->setStatus(true);
                return true;
            }
            else{
                return false;
            }     
        
        }
        catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function devolverLivro(Livro $livro, Usuario $usuario):bool{
        try{
            $indice = array_search($livro,$this->livros);
            if(is_numeric($indice)){
                $resultado = $usuario->devolverLivro($livro);
                if ($resultado == true){
                    $this->livros[$indice]->setStatus(true);
                    return true;
                }
                
                else return false;
                
            }
            else{
                return false;
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getLivros(){
        return $this->livros;
    }
}   
?>