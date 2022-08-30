
<h3>Se ha creado un evento con recurrencia de 1 minuto que elimina todos los registros de las base mayores a 1 (una) hora de su inserción</h3>


DROP EVENT IF EXISTS eliminar; 
CREATE DEFINER=root@localhost EVENT eliminar ON SCHEDULE EVERY 1 MINUTE STARTS '2022-08-28 23:07:03' ENDS '2022-09-30 23:07:03' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM ciudad WHERE (TIMEDIFF(CURRENT_TIMESTAMP, fecha_consulta)) > 1
