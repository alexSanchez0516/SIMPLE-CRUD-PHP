<?php 

namespace App;



class Services extends ActiveRecord
{
    protected static $tabla = 'services';
    protected static $colDB = ['id', 'name', 'description', 'services', 'price', 'imageProduct'];

    public int $id;
    public String $name;
    public String $description;
    public String $services;
    public int $price;
    public String $imageProduct;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->services = $args['services'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->imageProduct = $args['imageProduct'] ?? '';
    }
   
}
