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
("Vinicius Melz", "vinicius@gmail.com", "viniciusmelz", "dHhjYko2UHBYMzhQWHZnU1cxOVpPQT09Ojoz3ZQyiGDmYiTg4Vclxdks", 1),
("Johnny Becker", "johnny@gmail.com", "johnnybecker", "K0JkWHVHeUVGT21wcjFPZUx4UVZrQT09OjraK1dMgtl4HcYv9VYjLqyV", 0),
("Alice Souza", "alice@gmail.com", "alicesouza", "VGRsYVQwYUgrN0lnbmg2T21GUCtKQT09OjqKr2pUI\/Slfkk7\/hbE+e6F", 0),
("Bruno Lima", "bruno@gmail.com", "brunolima", "ZDNPMVN3RW5vdzIreFVhK3dpeUQ0UT09Ojr7HsmVrm3Az+LPVHUpI\/qs", 0),
("Carla Santos", "carla@gmail.com", "carlasantos", "WGRHeFgxQzh6MTIxSVp0QVhCaTVMQT09Ojo7lM57ZZHEeScrpdDrv8\/k", 0),
("Diego Ferreira", "diego@gmail.com", "diegoferreira", "Y2ZtR1EzaGNzT0FCTEp5UHUweXFDZz09OjrPMuQ0631goNUJ4DE44yX1", 1),
("Eduardo Oliveira", "eduardo@gmail.com", "eduardooliveira", "NDUzckc0M1FvbERUMURTVUdDNTRxUT09OjpwqrmPNUY9ydfN9N3wsN9+", 0),
("Fernanda Costa", "fernanda@gmail.com", "fernandacosta", "NkFkRG5ZYUlrL1JjZTIveTZQWUFSZz09OjrEMdgCw3GGi1hlSem8QqLU", 0);

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
SELECT * FROM participacaoEventos;