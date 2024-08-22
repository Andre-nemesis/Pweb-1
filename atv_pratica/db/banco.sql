drop database if exists db_teste;

create database db_teste;

use db_teste;

create table autor(
	id int primary key auto_increment,
	nome_autor varchar(80) not null,
	nacionalidade varchar(4) default 'BR'
);

create table estudante(
	nome_estudante varchar(80) not null,
	id int primary key auto_increment
);

create table livro(
	id int primary key auto_increment,
	titulo varchar(40) not null,
	ano int not null,
	status bool not null,
	fk_autor int,
	constraint fk_autor foreign key(fk_autor) references autor (id) on delete set null on update cascade
);

create table emprestimo(
	id int primary key auto_increment,
	fk_id_livro int,
	fk_id_estudante int,
    data_inicio date not null,
    data_fim date ,
	constraint fk_id_estudante foreign key(fk_id_estudante) references estudante (id) on delete set null on update cascade,
    constraint fk_id_livro foreign key(fk_id_livro) references livro (id) on delete set null on update cascade
);

-- Inserção de dados
DELIMITER $$

CREATE PROCEDURE insert_autor(in name_in varchar(80),in nacionalidade_in varchar(4))
BEGIN
    INSERT INTO autor (nome_autor,nacionalidade) values (name_in,nacionalidade_in);
END $$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE insert_livro(in titulo_in varchar(40),in ano_in int, in id_autor int)
BEGIN
    INSERT INTO livro (titulo,ano,fk_autor,status) values (titulo_in,ano_in,id_autor,true);
END $$

DELIMITER ;


DELIMITER $$
CREATE PROCEDURE insert_estudante(nome_in VARCHAR(80))
BEGIN
	INSERT INTO estudante (nome_estudante) VALUES (nome_in);
END $$
DELIMITER ;

-- apagar dados

DELIMITER $$

CREATE PROCEDURE dell_autor(in id_in int)
BEGIN
    delete from autor where autor.id=id_in;
    delete from livro where livro.fk_autor=id_in;
END $$

DELIMITER ;


DELIMITER $$

CREATE procedure dell_livro(in id_in int)
BEGIN
    delete from livro where livro.id=id_in;
END $$
	
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE dell_estudante (id_in INT)
BEGIN
	DELETE FROM estudante WHERE id = id_in;
END $$
DELIMITER ;


-- listagens
DELIMITER $$

CREATE procedure list_autor()
BEGIN
    select * from autor;
END $$

DELIMITER ;


DELIMITER $$

CREATE procedure list_livros()
BEGIN
    select * from livro;
END $$
	
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE list_estudante()
BEGIN
	SELECT * from estudante;
END $$
DELIMITER ;

-- functions de id

DELIMITER $$
CREATE FUNCTION getAutor_id(autor_name VARCHAR(80))
RETURNS INT
DETERMINISTIC
BEGIN
	DECLARE id_autor INT;
	SELECT id INTO id_autor FROM autor WHERE nome_autor = autor_name;
    IF id_autor IS NULL THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Autor não encontrado';
	END IF;
    RETURN id_autor;
END $$	
DELIMITER ;

drop function if exists getEstudante_id;

DELIMITER $$
CREATE FUNCTION getEstudante_id(nome_in VARCHAR(80))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE id_estudante INT;
    SELECT id INTO id_estudante FROM estudante WHERE nome_estudante = nome_in;
    IF id_estudante IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Estudante não encontrado';
    END IF;
    RETURN id_estudante;
END $$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION getLivro_id(livro_nome VARCHAR(80))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE id_livro INT;
    SELECT id INTO id_livro FROM livro WHERE titulo = livro_nome;
    IF id_livro IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Livro não encontrado';
    END IF;
    RETURN id_livro;
END $$
DELIMITER ;

-- funções de emprestimo


DELIMITER $$
CREATE PROCEDURE emprestar_livro (id_estudante INT, id_livro INT, data_ini DATE)
BEGIN
	INSERT INTO emprestimo (fk_id_livro,fk_id_estudante,data_inicio)
    VALUES (id_livro,id_estudante,data_ini);
    UPDATE livro SET status = false WHERE livro.id = id_livro;
END $$
DELIMITER ;

drop procedure if exists devolver_livro;

DELIMITER $$
CREATE PROCEDURE devolver_livro (id_livro INT,data_fim_in DATE)
BEGIN
	DECLARE data_emprestimo DATE;
    SELECT em.data_inicio INTO data_emprestimo FROM emprestimo AS em WHERE em.fk_id_livro = id_livro ORDER BY em.data_inicio DESC LIMIT 1 ;
    IF data_fim_in < data_emprestimo THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A data de devolução não pode ser anterior a data de empréstimo';
	ELSE
		UPDATE emprestimo SET data_fim = data_fim_in WHERE fk_id_livro = id_livro;
		UPDATE livro SET status = true WHERE id = id_livro;
	END IF;
END $$
DELIMITER ;

-- relatório

DELIMITER $$
CREATE PROCEDURE gerar_relatorio()
BEGIN
    SELECT l.titulo, es.nome_estudante,em.data_inicio, em.data_fim  
    FROM emprestimo AS em 
    JOIN livro as l ON em.fk_id_livro = l.id
    JOIN estudante AS es ON em.fk_id_estudante = es.id;
    
END $$
DELIMITER ;