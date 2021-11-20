<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;


class Services
{

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
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->services = $args['services'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->imageProduct = $args['imageProduct'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function create()
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

        //$query = "INSERT INTO service (serviceID, name) VALUES ($id, '${service}')";
        //self::$db->query($query) ?: header('Location: /');

        header('Location: /admin?state=1');
    }

    public function save()
    {
        if (($this->id) > 0) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function update()
    {

        $atributes = $this->sanitizeData();
        $services = $atributes['services'];
        unset($atributes['services']);


        foreach ($atributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = " UPDATE services SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = " . self::$db->escape_string($this->id);
        $query .= " LIMIT 1";
        self::$db->query($query) ?: header('Location: /error.html');


        //token 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

        //UPDATE SERVICE
        $listServices = explode(",", $services);
        debug($listServices);

        //$query = "UPDATE service SET name = '${service}' WHERE serviceID = ";
        $query .= self::$db->escape_string($this->id);
        $query .= " LIMIT 1";
        self::$db->query($query) ?: header('Location: /error.html');

        header('Location: /admin?state=1');
    }


    //Identificamos cual tenemos
    public function mapAtributes(): array
    {
        $atributes = [];

        foreach (self::$colDB as $col) {
            if ($col === 'id') continue;
            //Atributes en la posicion de col se va a llenar con los valores de la instancia 
            $atributes[$col] = $this->$col;
        }
        return $atributes;
    }

    //Sincroniza el objeto en memoria con  los nuevos cambios
    public function synchronize($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
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

    public function setImage($image): void
    {
        if ($image) {
            $this->imageProduct = $image;
        }
    }

    public function uploadImg($image, $imgDelete)
    {
        $nameImage = md5(uniqid(rand(), true));
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $completeImg = $nameImage . "." . $extension;
        if (isset($imgDelete)) {
            file_exists(FOLDER_IMG . $imgDelete) ? unlink(FOLDER_IMG . $imgDelete) : false;
        }

        $image = Image::make($image['tmp_name'])->fit(800, 600); //name and 
        $this->setImage($completeImg);

        if (!is_dir(FOLDER_IMG)) {
            mkdir(FOLDER_IMG);
        }

        $image->save(FOLDER_IMG . $completeImg);
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
        if (!$this->imageProduct && $this->id == 0) {
            //debug($this->id);
            self::$errors[] = "Photo is required";
        }

        return self::$errors;
    }


    public function delete(): void
    {
        //Services all tables db
        //Delete on cascade
        $query = "DELETE FROM services WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        file_exists(FOLDER_IMG . $this->imageProduct) ? unlink(FOLDER_IMG . $this->imageProduct) : false;
        self::$db->query($query) ? header('Location: /admin?state=3') : header('Location: /404.html');
    }

    public static function all(): array
    {
        $query = $query = "SELECT * FROM services";
        $data = self::consulSQL($query);

        return $data; //Return all data

    }

    public static function find($id)
    {

        $query = "SELECT * FROM services WHERE id = ${id}";
        $data = self::consulSQL($query);

        return array_shift($data); //Devuelve primer elemento de arreglo
    }

    public static function consulSQL($query): array
    {
        $data = self::$db->query($query);

        $services = [];

        while ($record = $data->fetch_assoc()) {
            $services[] = self::createObject($record);
        }
        $data->free(); //Liberar memoria

        return $services; //return mapp array to object
    }

    protected static function createObject($record)
    { //objeto en memoria espejo de la db
        $object = new self;

        foreach ($record as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value; //si existe ese objeto con esa clave
            }
        }
        return $object; //return object

    }
}
