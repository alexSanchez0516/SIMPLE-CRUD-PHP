<?php

namespace App;


class Services
{

    //DB
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'services', 'price', 'imageProduct'];

    public int $id;
    public String $name;
    public String $description;
    public String $services;
    public int $price;
    public String $imageProduct;

    protected static array $errors = [];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['title'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->services = $args['services'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->imageProduct = $args['imageProduct'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function save()
    {

        $atributes = $this->sanitizeData();
        $services = $atributes['services'];
        unset($atributes['services']);


        $query = "INSERT INTO services (";
        $query .= join(', ', array_keys($atributes));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributes));
        $query .= "')";

        self::$db->query($query) ?: header('Location: /');

        $query = "SELECT id FROM services ORDER BY id DESC";
        $results = self::$db->query($query);

        $id = ($results->fetch_assoc());
        $id = filter_var(intval($id['id']), FILTER_VALIDATE_INT) ?: header('Location: /');

        $listServices = explode(",", $services);

        foreach ($listServices as $service) {
            $query = "INSERT INTO service (serviceID, name) VALUES ($id, '${service}')";
            $data = self::$db->query($query) ?: header('Location: /');
        }
        header('Location: /admin');
    }

    //Identificamos cual tenemos
    public function mapAtributes(): array
    {
        $atributes = [];

        foreach (self::$colDB as $col) {
            if ($col === 'id') continue;
            if ($col === 'imageProduct') continue;
            //Atributes en la posicion de col se va a llenar con los valores de la instancia 
            $atributes[$col] = $this->$col;
        }
        return $atributes;
    }

    public function sanitizeData(): array
    {
        $atributes = $this->mapAtributes();
        $sanitize = [];

        foreach ($atributes as $key => $value) {
            $sanitize[$key] = self::$db->escape_string($value);
        }
        return $sanitize;
    }

    public function setImage($image): void {
        if ($image) {
            $this->imageProduct = $image;
        }
    }


    public static function getErrors(): array
    {
        return self::$errors;
    }

    public function validateData(): array
    {
        if (!$this->name) {
            self::$errors[] = "Title is required";
        }
        if (strlen($this->description) < 10) {
            self::$errors[] = "Description is required minimum 10 chars";
        }
        if (!$this->price > 5) {
            self::$errors[] = "Price is required";
        }
        if (!$this->services) {
            self::$errors[] = "services list is required";
        }
        if (!$this->imageProduct) {
            self::$errors[] = "Photo is required";
        }

        return self::$errors;
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
