
<h3>Se ha creado un evento con recurrencia de 1 minuto que elimina todos los registros de las base mayores a 1 (una) hora de su inserción</h3>


```sql
DROP EVENT IF EXISTS eliminar; 
CREATE DEFINER=root@localhost EVENT eliminar ON SCHEDULE EVERY 1 MINUTE STARTS '2022-08-28 23:07:03' ENDS '2022-09-30 23:07:03' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM ciudad WHERE (TIMEDIFF(CURRENT_TIMESTAMP, fecha_consulta)) > 1

CREATE TABLE `ciudad` (
  `nombre` varchar(255) NOT NULL,
  `temperatura` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha_consulta` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);
```



