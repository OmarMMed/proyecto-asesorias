CREATE DATABASE Asesorias;

use asesorias;

CREATE TABLE ResponsableTutorias(
	numeroCuenta VARCHAR(8),
    password VARCHAR(20),
    nombre VARCHAR(50),
    correo VARCHAR(40),
    celular char (10),
    PRIMARY KEY(numeroCuenta)
);

CREATE TABLE Estudiante(
	numCuenta VARCHAR(8),
    nombreCompleto varchar(50),
    password VARCHAR(20),
    carrera VARCHAR(30),
    grado SMALLINT,
    turno VARCHAR(30),
    grupo SMALLINT,
    promedio DOUBLE,
    celular CHAR(10),
    correo VARCHAR(40),
    PRIMARY KEY(numCuenta)
);

CREATE TABLE Asesores(
	idAsesor INT AUTO_INCREMENT,
    correo VARCHAR(40),
    nombre varchar(50),
    password VARCHAR(20),
    celular CHAR(10),
    carrera VARCHAR(30),
    grado SMALLINT,
    grupo SMALLINT,
    diasDisponibles VARCHAR(40),
    horario time,
    PRIMARY KEY(idAsesor)
);

CREATE TABLE Materias(
	idMateria int AUTO_INCREMENT,
    nombreMateria varchar(50),
    semestre tinyint,
    categorias VARCHAR(30),
    PRIMARY KEY (idMateria)
);

CREATE TABLE solicitud (
    id_solicitud INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_asesor INT,
    id_materia INT,
    id_estudiante VARCHAR(8),
    estado VARCHAR(45) NOT NULL, 
    FOREIGN KEY (id_asesor) REFERENCES asesores(idAsesor) ON DELETE CASCADE,
    FOREIGN KEY (id_materia) REFERENCES materias(idMateria) ON DELETE CASCADE,
    FOREIGN KEY (id_estudiante) REFERENCES estudiante(numCuenta)ON DELETE CASCADE
 );

CREATE TABLE Agenda(
	idAsesoria int AUTO_INCREMENT,
    nombreMateria varchar(40),
    Fecha DATETIME,
    nombreEstudiante VARCHAR(50),
    nombreAsesor VARCHAR(40),
    grupoEstudiante Varchar(3),
    carrera VARCHAR (40),
    id_sol INT,
    PRIMARY KEY(idAsesoria),
    FOREIGN KEY (id_sol) REFERENCES solicitud(id_solicitud) ON DELETE CASCADE
);



CREATE TABLE MateriasImpartidas(
	idAsesor INT,
    idMateria INT,
    disponibilidad char(1),
    FOREIGN KEY(idAsesor) REFERENCES Asesores(idAsesor) ON DELETE CASCADE,
    FOREIGN KEY(idMateria) REFERENCES Materias(idMateria) ON DELETE CASCADE
);

CREATE TABLE AsesoresDisp(
	idAsesor INT,
    nombreMateria Varchar(40),
    diasDisponibles char(10),
    horario varchar(10),
    disponibilidad char(1),
    FOREIGN KEY(idAsesor) REFERENCES Asesores(idAsesor) ON DELETE CASCADE
);
