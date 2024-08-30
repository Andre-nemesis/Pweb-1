<?php 

namespace Repository;

require_once '../../Model/Autor.php';
require_once '../../db/DBConnectionHandler.php';

use Exception;
use db\DBConectionHandler;
use Model\Autor;

class AutorRepository{
    /**
     * Classe de AutorRepository
     * Classe referente a gestão de da entrada de dados referente ao modelo Autor.
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
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
                while ($row = $result->fetch_assoc()){
                    $autores[] = new Autor($row['id'], $row['nome_autor'], $row['nacionalidade']);
                }
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

    // Retornar o ID do autor com base no seu nome
    public function getAutorId(string $nome_autor){
        $this->openConnection();
        $query = "SELECT getAutor_id(?) AS 'id';";
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
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
        
    }

    public function deletarAutor(int $id_autor){
        $this->openConnection();
        $query = 'CALL dell_autor(?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$id_autor);
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

    // Buscar um autor pelo seu ID
    public function findById(int $id) {
        $this->openConnection();
        
        $sql = "SELECT id, nome_autor, nacionalidade FROM autor WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        try{
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
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
        
    }

    public function editarAutor(Autor $autor){
        $nome = $autor->getNome();
        $nacionalidade = $autor->getNacionalidade();
        $autor_id = $this->getAutorId($autor->getNome());
        $this->openConnection();
        $query = 'UPDATE autor SET autor.nome_autor = ?, autor.nacionalidade = ? WHERE autor.id = ?';
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
            $this->conn->close();
        }
    }
}
?>