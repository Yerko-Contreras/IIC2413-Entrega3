CREATE OR REPLACE FUNCTION

aprobar_rechazar(accion varchar, codigo_vuelo_a_cambiar varchar)

RETURNS VOID AS $$

DECLARE

BEGIN

if accion = 'aprobra' THEN
    UPDATE vuelo

END $$
language plpgsql

