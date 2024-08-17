DROP DATABASE Eventos;

CREATE DATABASE Eventos;
USE Eventos;

CREATE TABLE Usuarios(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nomeUsuario VARCHAR(255) UNIQUE NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	login VARCHAR(255) UNIQUE NOT NULL,
	senha VARCHAR(255) NOT NULL,
	ehAdmin bit NOT NULL,
	registroCriado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Eventos (
	id INT AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(255) NOT NULL,
	descricao TEXT,
	localEvento VARCHAR(255),
	dataEvento DATE,
	registroCriado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE participacaoEventos (
	id_participacao INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    evento_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (evento_id) REFERENCES Eventos(id) ON DELETE CASCADE
);

INSERT INTO usuarios (nomeUsuario, email, login, senha, ehAdmin) VALUES
("Vinicius Melz", "vinicius@gmail.com", "viniciusmelz", "senha", 1),
("Johnny Becker", "johnny@gmail.com", "johnnybecker", "12345", 0),
("Alice Souza", "alice@gmail.com", "alicesouza", "password123", 0),
("Bruno Lima", "bruno@gmail.com", "brunolima", "brunosenha", 0),
("Carla Santos", "carla@gmail.com", "carlasantos", "carla1234", 0),
("Diego Ferreira", "diego@gmail.com", "diegoferreira", "senha123", 1),
("Eduardo Oliveira", "eduardo@gmail.com", "eduardooliveira", "edusenha", 0),
("Fernanda Costa", "fernanda@gmail.com", "fernandacosta", "fernanda123", 0);

INSERT INTO eventos (titulo, descricao, localEvento, dataEvento) VALUES
("Kakedo Day", "Dia para reviver os videogames antigos", "AFUNISC", "2024-07-24"),
("Tech Talk", "Palestra sobre as últimas tendências em tecnologia", "Centro de Convenções", "2024-08-10"),
("Workshop de Desenvolvimento Web", "Aprenda a construir sites do zero", "Laboratório de Informática", "2024-09-15"),
("Conferência de IA", "Discussão sobre os avanços em Inteligência Artificial", "Auditório Principal", "2024-10-05"),
("Hackathon 2024", "Competição de programação com prêmios incríveis", "Espaço Inovação", "2024-11-20"),
("Feira de Startups", "Exposição das startups mais promissoras da região", "Pavilhão de Feiras", "2024-12-01");

INSERT INTO participacaoEventos (usuario_id, evento_id) VALUES
(2, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 1),
(6, 2),
(1, 3),
(2, 4),
(3, 5),
(4, 1);

SELECT * FROM usuarios;
SELECT * FROM eventos;
SELECT * FROM usuarios_eventos;