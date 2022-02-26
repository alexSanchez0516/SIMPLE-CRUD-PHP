<?php 



function connectDB() : mysqli{
    //$db = new mysqli('localhost', 'xymind', '', 'divisione_crud'); pass:169
    if (!$db) {
        echo "No hay conexion";
        exit;
    } 

    return $db;
    
}



