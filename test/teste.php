<?php 

// conexão para servidor padrão
/* 
$server = 'localhost'; // -> porta padrão
$user = 'root';
$password = 'andre';
$dbname = 'nome_db';
*/
// conexão para servidor de teste
$server = '127.0.0.1:3306'; // servidor de teste
$user = 'andre';
$password = 'andre';
$dbname = 'db_teste';

$conn = new mysqli($server, $user, $password, $dbname);

if ($conn->connect_error){
    die("Connection error: " . $conn->connect_error);
}
else{
    echo "Connected successfully";
}