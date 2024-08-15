<?php 
namespace test;

require_once './atv_pratica/Repository/AutorRespository.php';
use Repository\AutorRepository;

$ee = new AutorRepository();
$ee->cadastrarAutor('mumia','AG');
echo $ee->getAutorId('mumia');
?>