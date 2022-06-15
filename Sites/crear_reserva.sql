CREATE OR REPLACE FUNCTION

crear_reserva(codigo varchar, pasaporte_1 varchar, pasaporte_2 varchar, pasaporte_3 varchar)

RETURNS varchar as $$

DECLARE
    hay_pasaporte_1 integer;
    hay_pasaporte_2 integer;
    hay_pasaporte_3 integer;
    hay_pasaportes integer;
    usuario_1 RECORD;
    usuario_2 RECORD;
    usuario_3 RECORD;
    vuelos_reservados RECORD;
    vuelo_a_reservar RECORD;
    n_ticket integer;
    n_reserva integer;
BEGIN

    hay_pasaporte_1 = 0;
    hay_pasaporte_2 = 0;
    hay_pasaporte_3 = 0;
    error = 0;
    hay_pasaportes = 0;
    
    SELECT * INTO vuelo_a_reservar
    FROM vuelo
    WHERE codigo_vuelo = codigo;

    IF NOT pasaporte_1 = '' THEN
        hay_pasaporte_1 = 1;
        hay_pasaportes = 1;
    END IF;
    
    IF NOT pasaporte_2 = '' THEN
        hay_pasaporte_2 = 1;
        hay_pasaportes = 1;
    END IF;
    
    IF NOT pasaporte_3 = '' THEN
        hay_pasaporte_3 = 1;
        hay_pasaportes = 1;
    END IF;

    IF hay_pasaportes = 1 THEN
        IF hay_pasaporte_1 = 1 THEN
            
            SELECT * into usuario_1
            FROM pasajeros_compradores
            WHERE pasaporte = pasaporte_1;

            IF usuario_1 IS NULL THEN
                RETURN 'No existe el primer pasaporte';
                error = 1;
            END IF;
        END IF;

        IF hay_pasaporte_2 = 1 THEN
            IF usuario_2 IS NULL THEN
                RETURN 'No existe el segundo pasaporte';
                error = 1;
            END IF;
        END IF;

        IF hay_pasaporte_3 = 1 THEN
            IF usuario_3 IS NULL THEN
                RETURN'No existe el tercer pasaporte';
                error = 1;
            END IF;
        END IF;

        SELECT * into vuelos_reservados
        FROM vuelo, ticket
        WHERE vuelo.vuelo_id = ticket.vuelo_id AND
        (ticket.pasaporte_pasajero = pasaporte_1 OR
        ticket.pasaporte_pasajero = pasaporte_2 OR
        ticket.pasaporte_pasajero = pasaporte_3) AND
        (vuelo_a_reservar.fecha_salida BETWEEN vuelo.fecha_salida AND vuelo.fecha_llegada OR
        vuelo_a_reservar.fecha_llegada BETWEEN vuelo.fecha_salida AND vuelo.fecha_llegada);

        IF vuelos_reservados IS NOT NULL THEN
            RETURN'Uno de los usuarios tiene un vuelo en las fechas programadas';
            error = 1;
        END IF

        IF error = 0;
            
            SELECT numero_ticket into n_ticket
            FROM ticket
            WHERE ticket.numero_ticket >= ALL(
                SELECT numero_ticket
                FROM ticket
            );

            n_ticket += 1;

            SELECT reserva_id into n_reserva
            FROM reserva
            WHERE reserva.reserva_id >= ALL(
                SELECT reserva_id
                FROM reserva
            );

            n_reserva += 1;

            IF hay_pasaporte_1 THEN
                INSERT INTO reserva (
                    reserva_id, numero_ticket, pasaporte_comprador
                ) VALUES (
                    n_reserva, n_ticket, pasaporte_1
                );
                n_ticket += 1;
            END IF;

            IF hay_pasaporte_2 THEN
                INSERT INTO reserva (
                    reserva_id, numero_ticket, pasaporte_comprador
                ) VALUES (
                    n_reserva, n_ticket, pasaporte_2
                );
                n_ticket += 1;
            END IF;

            IF hay_pasaporte_3 THEN
                INSERT INTO reserva (
                    reserva_id, numero_ticket, pasaporte_comprador
                ) VALUES (
                    n_reserva, n_ticket, pasaporte_3
                );
                n_ticket += 1;
            END IF;
        END IF;


END $$
