-- 1)Autos ordenados por precio
SELECT id as 'ID', marca as 'Marcas', modelo as 'Modelo', precio as 'Precio', anio as 'Año'
FROM autos
ORDER BY precio ASC;

-- 2)Autos con precio menor a 10.000.000
SELECT id as 'ID', marca as 'Marca', modelo as 'Modelo', precio as 'Precio', anio as 'Año'
FROM autos
WHERE precio < 10000000;

-- 3) Clientes que realizaron al menos una compra
SELECT DISTINCT c.id as 'ID', c.nombre as 'Nombre', c.apellido as 'Apellido', c.email as 'Mail'
FROM clientes c
JOIN ventas v ON v.cliente_id = c.id;

-- 4) Total de autos vendidos por cliente
SELECT c.id as 'ID', c.nombre as 'Nombre', c.apellido as 'Apellido', COUNT(v.id) AS Ventas_totales
FROM clientes c
JOIN ventas v ON v.cliente_id = c.id
GROUP BY c.id, c.nombre, c.apellido;

-- 5) Auto más vendido (modelo + cantidad)
SELECT a.modelo as 'Modelo', COUNT(v.id) AS 'Cantidad_vendida'
FROM autos a
JOIN ventas v ON v.auto_id = a.id
GROUP BY a.id, a.modelo
ORDER BY cantidad_vendida DESC
LIMIT 1;