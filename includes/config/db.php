<?php 



function connectDB() : mysqli{
    $db = new mysqli('localhost', 'xymind', '1690001299Gr.', 'divisione_crud');
    if (!$db) {
        echo "No hay conexion";
        exit;
    } 

    return $db;
    
}



