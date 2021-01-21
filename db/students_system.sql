USE students_system;

/*Estructura general de las tablas*/
CREATE TABLE Usuario(
    idUsuario CHAR(10) NOT NULL UNIQUE,
    clave VARCHAR(18) NOT NULL,
    rol SMALLINT NOT NULL
);

CREATE TABLE Alumno(
    boleta CHAR(10) NOT NULL UNIQUE,
    nombre VARCHAR(30) NOT NULL,
    apPat VARCHAR(15) NOT NULL,
    apMat VARCHAR(15) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    correoE VARCHAR(50) NOT NULL,
    genero CHAR(1) NOT NULL,
    curp CHAR(18) NOT NULL,
    grupo SMALLINT NOT NULL,
    idEscuela SMALLINT,
    promedio VARCHAR(5) NOT NULL,
    opcionESCOM SMALLINT NOT NULL,
    calle VARCHAR(20) NOT NULL,
    colonia VARCHAR(60) NOT NULL,
    numero VARCHAR(4) NOT NULL,
    codigoP VARCHAR(5) NOT NULL,
    idEntFed SMALLINT NOT NULL,
    fechNac DATE NOT NULL,
    nombreEscuela VARCHAR(30),
    verificado BOOLEAN NOT NULL
);

CREATE TABLE Administrador(
    numeroEmpleado CHAR(10) NOT NULL UNIQUE,
    nombre VARCHAR(18) NOT NULL,
    apPat VARCHAR(15) NOT NULL,
    apMat VARCHAR(15) NOT NULL,
    puesto VARCHAR(10) NOT NULL
);

CREATE TABLE Rol(
    idRol SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombreRol VARCHAR(13) NOT NULL
);

CREATE TABLE EntidadFederativa(
    idEntFed SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL
);

CREATE TABLE CatalogoDeEscuelas(
    idEscuela SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE Grupo(
    idGrupo SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    horaExamen TIME NOT NULL,
    inscritos SMALLINT NOT NULL
);

/* Llaves Primarias 1*/
ALTER TABLE
    Usuario
ADD
    CONSTRAINT UsPk PRIMARY KEY(idUsuario);

/* Llaves foraneas */
ALTER TABLE
    Alumno
ADD
    CONSTRAINT AlFk1 FOREIGN KEY(boleta) REFERENCES Usuario(idUsuario);

ALTER TABLE
    Alumno
ADD
    CONSTRAINT AlFk3 FOREIGN KEY(idEscuela) REFERENCES CatalogoDeEscuelas(idEscuela);

ALTER TABLE
    Alumno
ADD
    CONSTRAINT AlFk4 FOREIGN KEY(idEntFed) REFERENCES EntidadFederativa(idEntFed);

ALTER TABLE
    Administrador
ADD
    CONSTRAINT AdFk1 FOREIGN KEY(numeroEmpleado) REFERENCES Usuario(idUsuario);

ALTER TABLE
    Usuario
ADD
    CONSTRAINT RlFk1 FOREIGN KEY(rol) REFERENCES Rol(idRol);

/* Llaves Primarias 2*/
ALTER TABLE
    Alumno
ADD
    CONSTRAINT AlPk PRIMARY KEY(boleta);

/*Catalogo Entidades federativas*/
INSERT INTO
    EntidadFederativa(nombre)
VALUES
    ('Aguascalientes'),
    ('Baja California'),
    ('Baja California Sur'),
    ('Campeche'),
    ('Chiapas'),
    ('Chihuahua'),
    ('Ciudad de México'),
    ('Coahuila'),
    ('Colima'),
    ('Durango'),
    ('Estado de México'),
    ('Guanajuato'),
    ('Guerrero'),
    ('Hidalgo'),
    ('Jalisco'),
    ('Michoacán'),
    ('Morelos'),
    ('Nayarit'),
    ('Nuevo León'),
    ('Oaxaca'),
    ('Puebla'),
    ('Querétaro'),
    ('Quintana Roo'),
    ('San Luis Potosí'),
    ('Sinaloa'),
    ('Sonora'),
    ('Tabasco'),
    ('Tamaulipas'),
    ('Tlaxcala'),
    ('Veracruz'),
    ('Yucatán'),
    ('Zacatecas');

/*Catalogo Escuelas*/
INSERT INTO
    CatalogoDeEscuelas(nombre)
VALUES
    ('CECyT No. 1 Gonzalo Vázquez Vela'),
    ('CECyT No. 2 Miguel Bernard'),
    ('CECyT No. 3 Estanislao Ramírez Ruiz'),
    ('CECyT No. 4 Lázaro Cárdenas'),
    ('CECyT No. 5 Benito Juárez'),
    ('CECyT No. 6 Miguel Othón de Mendizábal'),
    ('CECyT No. 7 Cuauhtémoc'),
    ('CECyT No. 8 Narciso Bassols'),
    ('CECyT No. 9 Juan de Dios Bátiz'),
    ('CECyT No. 10 Carlos Vallejo Márquez'),
    ('CECyT No. 11 Wilfrido Massieu'),
    ('CECyT No. 12 José María Morelos'),
    ('CECyT No. 13 Ricardo Flores Magón'),
    ('CECyT No. 14 Luis Enrique Erro'),
    ('CECyT No. 15 Diódoro Antúnez Echegaray'),
    ('CECyT No. 16 Hidalgo'),
    ('CECyT No. 17 León, Guanajuato'),
    ('CECyT No. 18 Zacatecas'),
    ('CECyT No. 19 Leona Vicario'),
    ('CET 1 Walter Cross Buchanan');

/*Catalogo Roles*/
INSERT INTO
    Rol(nombreRol)
VALUES
    ('Administrador'),
    ('Alumno');

INSERT INTO
    Usuario
VALUES
    ('ADMIN12345', 'ADMIN12345', 1);

INSERT INTO
    Administrador
VALUES
    (
        'ADMIN12345',
        'Juan',
        'Perez',
        'Perez',
        'Profesor'
    );

INSERT INTO
    Grupo(horaExamen, inscritos)
VALUES
    ("08:00:00", 0),
    ("09:45:00", 0),
    ("11:30:00", 0),
    ("13:15:00", 0),
    ("15:00:00", 0),
    ("16:45:00", 0);

INSERT INTO
    Usuario
VALUES
    ('ADMIN99999', 'ADMIN99999', 1);

INSERT INTO
    Administrador
VALUES
    (
        'ADMIN99999',
        'Pedro',
        'Diaz',
        'Diaz',
        'Jefe'
    );