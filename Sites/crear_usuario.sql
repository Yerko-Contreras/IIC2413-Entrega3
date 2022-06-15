CREATE OR REPLACE FUNCTION

crear_usuario(username_nuevo varchar, contrasena_nueva varchar, tipo_nuevo varchar)

RETURNS VOID AS 

$$
DECLARE
    usuario RECORD;
    id_mas_grande integer;
BEGIN

    SELECT id INTO id_mas_grande 
    FROM Usuarios 
    WHERE id >= ALL (
        SELECT id
        FROM Usuarios
        )
    LIMIT 1;
    
    IF id_mas_grande IS NULL THEN 
        id_mas_grande = 1;
    END IF;
    
    SELECT * INTO usuario 
    FROM Usuarios 
    WHERE username = username_nuevo AND 
    tipo = tipo_nuevo
    LIMIT(1);

    IF usuario IS NOT NULL THEN
        RAISE EXCEPTION 'Este usuario ya existe';
    ELSE
        INSERT INTO Usuarios (
            id, username, contrasena, tipo
        ) VALUES (
            id_mas_grande, username_nuevo, contrasena_nueva, tipo_nuevo
        );
    END IF;
END 
$$ language plpgsql
