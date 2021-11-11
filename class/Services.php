<?php

namespace App;


class Services {

    //DB
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'price', 'imageProduct'];

    public int $id;
    public String $name;
    public String $description;
    public int $price;
    public String $imageProduct;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['title'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->imageProduct = $args['imageProduct'] ?? 'prueba.png';
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function save() {
        
        //Sanit dates
        $atributes = $this->sanitizeData();

        $query = "INSERT INTO services (";
        $query .= join(', ' , array_keys($atributes));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributes));
        $query .= "')";

        $data = self::$db->query($query);

        $query = "SELECT id FROM services ORDER BY id DESC";
        $results = self::$db->query($query);
        $id = null;  //Corregir
        var_dump($id);
        exit;

        $services = self::$db->escape_string($_POST['services']);
        $listServices = explode(",", $services);

        foreach($listServices as $service) {
            $query = "INSERT INTO service (serviceID, name) VALUES ($this->id, '${service}')";
            echo $query;
        }
        debug($listServices);
    }

    //Identificamos cual tenemos
    public function mapAtributes() : array {
        $atributes = [];

        foreach(self::$colDB as $col) {
            if ($col === 'id') continue;
            //Atributes en la posicion de col se va a llenar con los valores de la instancia 
            $atributes[$col] = $this->$col; 
        }
        return $atributes;
    }

    public function sanitizeData() : array {
        $atributes = $this->mapAtributes();
        $sanitize = [];

        foreach($atributes as $key => $value) {
            $sanitize[$key] = self::$db->escape_string($value);
        }
        return $sanitize;
    }
    
    

}
