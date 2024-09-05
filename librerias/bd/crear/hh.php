"INSERT INTO sessiones (session_id, cod_usuario, usuario, nombre_usuario,
        ap_usuario, am_usuario, tipo_usuario, session_start, session_end
    ) VALUES (
        '$session_id', $cod_usuario, '$usuario', '$nombre_usuario', '$ap_usuario', '$am_usuario', '$tipo_usuario', NOW(), '$session_end'
    ) ON DUPLICATE KEY UPDATE
        cod_usuario = VALUES(cod_usuario),
        usuario = VALUES(usuario),
        nombre_usuario = VALUES(nombre_usuario),
        ap_usuario = VALUES(ap_usuario),
        am_usuario = VALUES(am_usuario),
        tipo_usuario = VALUES(tipo_usuario),
        session_start = VALUES(session_start),
        session_end = VALUES(session_end)";
