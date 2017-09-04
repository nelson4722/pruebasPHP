create database clinica;
use clinica;

drop database test;

CREATE TABLE IF NOT EXISTS `pacientes` (
`id_paciente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`clave` varchar(10) NOT NULL,
`nombre` varchar(80) NOT NULL,
`apellido_paterno` varchar(80) NOT NULL,
`apellido_materno` varchar(80) NOT NULL,
`sexo` varchar(2) NOT NULL,
`domicilio` text NOT NULL,
PRIMARY KEY (`id_paciente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
Insert into pacientes values(1,"hola","nelson","alegria","bello","M","Casa");
Insert into pacientes values(2,"chao","christian","alegria","bello","M","Casa");
Insert into pacientes values(3,"nosellama","cabezon","alegria","bello","M","Casa");


Select * from pacientes;

CREATE TABLE IF NOT EXISTS `medicos` (
`id_medico` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`cedula` varchar(10) NOT NULL,
`nombre_medico` varchar(200) NOT NULL,
PRIMARY KEY (`id_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

Insert into medicos values(1,"18358149k","Jaime");
Insert into medicos values(2,"174267626","Joaquin");
Insert into medicos values(3,"172558941","Ricardo");


CREATE TABLE IF NOT EXISTS `consultas_medicas` (
`id_consulta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`fecha_consulta` date NOT NULL,
`id_paciente` int(5) NOT NULL,
`id_medico` int(5) NOT NULL,
`consultorio` varchar(20) NOT NULL,
`diagnostico` text NOT NULL,
PRIMARY KEY (`id_consulta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

Insert into consultas_medicas values(1,'2012-2-2',1,1,"chuchunco","cancer");
Insert into consultas_medicas values(2,'2013-2-2',2,2,"bicentenario","resfrio");
Insert into consultas_medicas values(3,'2014-2-2',3,3,"integramedica","hambre");

SELECT consultas_medicas.fecha_consulta, consultas_medicas.consultorio, consultas_medicas.diagnostico, medicos.nombre_medico 
	FROM consultas_medicas 
	Inner Join pacientes ON consultas_medicas.id_paciente = pacientes.id_paciente 
	Inner Join medicos ON consultas_medicas.id_medico = medicos.id_medico
	WHERE pacientes.id_paciente = 1;