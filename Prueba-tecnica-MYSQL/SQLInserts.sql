INSERT INTO autos (marca, modelo, precio, anio) VALUES
('Toyota', 'Corolla', 9500000, 2022),
('Volkswagen', 'Gol Trend', 5800000, 2020),
('Peugeot', '208', 7200000, 2021),
('Chevrolet', 'Onix', 6500000, 2021),
('Ford', 'Ranger', 15500000, 2023),
('Renault', 'Kangoo', 8800000, 2022),
('Fiat', 'Cronos', 7400000, 2023),
('Nissan', 'Frontier', 16200000, 2023),
('Honda', 'Civic', 11800000, 2022),
('Jeep', 'Renegade', 13400000, 2023);

INSERT INTO clientes (nombre, apellido, email) VALUES
('Juan', 'Pérez', 'juan.perez@email.com'),
('María', 'Gómez', 'maria.gomez@email.com'),
('Carlos', 'Rodríguez', 'carlos.rod@email.com'),
('Lucía', 'Fernández', 'lucia.fer@email.com'),
('Martín', 'Díaz', 'martin.diaz@email.com'),
('Sofía', 'Martínez', 'sofia.martinez@email.com'),
('Diego', 'López', 'diego.lopez@email.com'),
('Laura', 'Sánchez', 'laura.sanchez@email.com'),
('Andrés', 'Romero', 'andres.romero@email.com'),
('Valentina', 'Torres', 'valen.torres@email.com'),
('Gabriel', 'Molina', 'gabriel.molina@email.com'),
('Camila', 'Ríos', 'camila.rios@email.com'),
('Esteban', 'Suárez', 'esteban.suarez@email.com'),
('Natalia', 'Moreno', 'natalia.moreno@email.com'),
('Franco', 'Benítez', 'franco.benitez@email.com');

INSERT INTO ventas (cliente_id, auto_id, fecha) VALUES
(1, 2, '2024-01-15'),
(2, 3, '2024-02-20'),
(3, 2, '2024-03-05'),
(4, 1, '2024-03-22'),
(5, 5, '2024-04-10'),
(6, 2, '2024-05-03'),
(7, 7, '2024-06-11'),
(8, 2, '2024-06-25'),
(9, 9, '2024-07-08'),
(10, 2, '2024-07-22'),
(1, 4, '2024-08-01'),
(2, 6, '2024-08-15'),
(3, 2, '2024-09-05'),
(6, 8, '2024-09-20');