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

    protected static $errores = [];
    

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

        $data = self::$db->query($query) ? : header('Location: /');

        $query = "SELECT id FROM services ORDER BY id DESC";
        $results = self::$db->query($query);
        
        $id = ($results->fetch_assoc());
        $id = filter_var(intval($id['id']), FILTER_VALIDATE_INT) ? : header('Location: /');

        $services = self::$db->escape_string($_POST['services']);
        $listServices = explode(",", $services);

        foreach($listServices as $service) {
            $query = "INSERT INTO service (serviceID, name) VALUES ($id, '${service}')";
            $data = self::$db->query($query) ? : header('Location: /');
        }
        header('Location: /admin');
        
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

    public static function getErrors() : Array {
        return self::$errores;
    } 
    
    
}