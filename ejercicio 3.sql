create database deportes;
use deportes;
drop database deportes;
create table jugador(Codejugador varchar(12), nombre varchar(10), apellido1 varchar(10),apellido2 varchar(10), demarcacion varchar(10),Codequipo_FK varchar(12), primary key(Codejugador),FOREIGN KEY (Codequipo_FK) REFERENCES equipo(Codequipo));
create table equipo(Codequipo varchar(12), nombre varchar(10), deporte varchar(10),primary key(Codequipo));
ALTER TABLE equipo Modify COLUMN nombre VARCHAR(20);
ALTER TABLE jugador ADD FOREIGN KEY (Codequipo) REFERENCES deportes.equipo(Codigo) ON DELETE CASCADE ON UPDATE CASCADE ;
insert into equipo values("rcm","Real Campello","Baloncesto");
insert into equipo values("can","Canoa","Natacion");
insert into equipo values("ssj","Sporting de San Juan","Futbol");

insert into jugador values("rlm","Raúl", "Martínez", "López", "pivot","rcm");
insert into jugador values("rl","Raúl", "López","", "saltador","can");
insert into jugador values("jl","Jordi", "López","","nadador","can");
insert into jugador values("rol","Roberto", "Linares", "López", "base","rcm");

Select * from jugador;
select * from equipo;
Select j.nombre, j.apellido1, j.demarcacion, e.nombre from jugador j,equipo e where j.Codequipo_FK=e.Codequipo;
SELECT nombre FROM equipo WHERE Codequipo NOT IN ( SELECT Codequipo_FK FROM jugador);
Select nombre, apellido1,apellido2 from jugador where apellido1="López" or apellido2="López";
Select nombre,apellido1, apellido2 from jugador where demarcacion like"%nadador%";
SELECT e.nombre, count(*) as cantidad FROM jugador j, equipo e where j.Codequipo_FK=e.Codequipo GROUP BY e.nombre;
SELECT e.deporte, count(*) as cantidad FROM jugador j, equipo e where j.Codequipo_FK=e.Codequipo GROUP BY e.deporte;
Select e.nombre, max(e.Codequipo) as maximo from equipo e, jugador j where j.Codequipo_FK=e.Codequipo;

SELECT e.nombre, count(*) FROM jugador j, equipo e where j.Codequipo_FK=e.Codequipo GROUP BY jugador.Codequipo_FK HAVING COUNT(*)>=ALL(SELECT count(*)FROM jugador GROUP BY e.nombre);

9- Crear una consulta que muestre el equipo que más jugadores tiene.;

ALTER TABLE jugador ADD antiguedad INT;
UPDATE jugador SET antiguedad=4 WHERE nombre="Roberto" AND apellido1="Linares";