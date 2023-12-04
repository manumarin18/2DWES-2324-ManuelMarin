DROP DATABASE empleadosnn;
CREATE DATABASE empleadosnn;

USE empleadosnn;

CREATE TABLE departamento(
	cod_dpto  VARCHAR(4),
 	nombre_dpto VARCHAR(40),
 	CONSTRAINT pk_departamento PRIMARY KEY (cod_dpto))
 ENGINE=InnoDB;

CREATE TABLE empleado
(dni 			VARCHAR(9),
 nombre_emple 	VARCHAR(40),
 salario		FLOAT(6),
 fecha_nac 		DATE,
 CONSTRAINT pk_empleado PRIMARY KEY (dni))
 ENGINE=InnoDB;
 
 CREATE TABLE emple_dpto
 (dni VARCHAR(9),
  cod_dpto VARCHAR(4),
  fecha_ini DATE,
  fecha_fin DATE,
	CONSTRAINT pk_emple_dpto
		PRIMARY KEY (dni,cod_dpto,fecha_ini),
	CONSTRAINT fk_dni FOREIGN KEY (dni)
		REFERENCES empleado(dni),
	CONSTRAINT fk_cod_dpto FOREIGN KEY (cod_dpto)
		REFERENCES departamento(cod_dpto))
	ENGINE=InnoDB;
						 
INSERT INTO departamento (cod_dpto,nombre_dpto)
	VALUES ('D001','CONTABILIDAD');						 
INSERT INTO empleado (dni,nombre_emple,salario,cod_dpto)
	VALUES('11111111A','ALFONSO',50000,'D001');
INSERT INTO empleado (dni,nombre_emple,salario,cod_dpto)
	VALUES('22222222A','PEPE',50000,'D002');

