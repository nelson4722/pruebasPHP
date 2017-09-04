create database productos1;#crea base de datos
use productos1;#usa base de datos
create table productos(codigo int,nombre varchar (30), precio decimal(6,2),fechaalta date, primary key (codigo)); #crea productos
INSERT INTO productos VALUES (01,'Afilador', 2.50, '2007-11-02');#inseta afilador
INSERT INTO productos VALUES (02,'Silla mod. ZAZ', 20, '2007-11-03');#inserta silla
INSERT INTO productos VALUES (03,'Silla mod. XAX', 25, '2007-11-03');#inserta silla
SELECT * FROM productos;#muestra productos
SELECT * FROM productos WHERE nombre='Afilador';#muestra productos identicos al afilador
SELECT * FROM productos WHERE nombre LIKE 'Silla%';#muestra productos tipo silla
SELECT nombre, precio FROM productos WHERE precio > 22;#muestra productos de precio mayor a 22
SELECT avg(precio) as promedio FROM productos WHERE nombre LIKE 'Silla%';#muestra promedio del precio de las sillas
ALTER TABLE productos ADD categoria varchar(10);#agrega la categoria al producto
SELECT * FROM productos;
SET SQL_SAFE_UPDATES = 0;
UPDATE productos SET categoria="utensilio";#actualiza la categoría utensilio a todos los productos.
UPDATE productos SET categoria='silla' WHERE nombre LIKE 'Silla%';#actualiza la categoría silla a las sillas
SELECT DISTINCT categoria FROM productos;#muestra las diferentes categorías de productos
SELECT categoria, count(*) as cantidad FROM productos GROUP BY categoria;#cuenta la cantidad de productos por categoría