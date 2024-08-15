<?php 

namespace Repository;

require_once '../Model/Autor.php';
require_once '../db/DBConnectionHandler.php';

use Exception;
use db\DBConectionHandler;
use Model\Autor;

class AutorRepository{
    private DBConectionHandler $connection_handle;
    private $conn;

    public function __construct(){}

    public function openConnection(){
        $this->connection_handle = new DBConectionHandler();
        $this->conn = $this->connection_handle->getConnection();
    }

    public function cadastrarAutor(Autor $autor){
        $nome = $autor->getNome();
        $nacionalidade = $autor->getNacionalidade();
        $this->openConnection();
        try{
            $stmt = $this->conn->prepare("CALL insert_autor(?, ?)");
            $stmt->bind_param("ss", $nome, $nacionalidade);
            $stmt->execute();
            if ($stmt->error){
                throw new Exception("Error inserting autor: " . $stmt->error);
            }
            $stmt->close();
            
        }   
        catch (Exception $e) {
            echo $e->getMessage();
        }
        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }

    public function listar_autores(){
        $this->openConnection();
        $query = 'CALL list_autor()';
        try{
            $result = $this->conn->query($query);
            $autores = [];
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc())
                $autores[] = new Autor($row['id'], $row['name'], $row['nascionalidade']);
                $result->free();
                return $autores;
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }
    }

    // ajeitar aqui
    public function getAutorId(string $nome_autor){
        $this->openConnection();
        $query = "CALL getAutor_id(?);";
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $nome_autor);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $stmt->close();
                return $row['id'];
            }
            else{
                throw new Exception("Autor not found.");
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }
        
    }

    public function deletarAutor(string $nome){
        $id_autor = $this->getAutorId($nome);
        $this->openConnection();
        $query = 'CALL dell_autor(?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('d',$id_autor);
        try{
            $stmt->execute();
            $stmt->close();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
        
    }

    public function findById(int $id) {
        $this->openConnection();
        
        $sql = "SELECT id, nome, nacionalidade FROM autor WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $this->conn->error);
        }
        $nome= '';
        $nacionalidade = '';
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $nacionalidade);

        if ($stmt->fetch()) {
            $stmt->close();
            $autor =  new Autor($id, $nome, $nacionalidade);
            return $autor;
        }

        $stmt->close();
        return null;
    }

    public function editarAutor(Autor $autor){
        $nome = $autor->getNome();
        $nacionalidade = $autor->getNacionalidade();
        $autor_id = $this->getAutorId($autor->getNome());
        $this->openConnection();
        $query = 'UPDATE autor SET autor.name = ?, autor.nascionalidade = ? WHERE autor.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssi',$nome,$nacionalidade,$autor_id);
        
        try{
            $stmt->execute();
            $stmt->close();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }
}
?>