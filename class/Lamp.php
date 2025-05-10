<?php
require_once "autoload.php";

class lamp{
    protected $id;
    protected $name;
    protected $on;
    protected $model;
    protected $wattage;
    protected $zone;

    function __construct($id, $name, $on, $model, $wattage, $zone){
        $this->id = $id;
        $this->name = $name;
        $this->on = $on;
        $this->model = $model;
        $this->wattage = $wattage;
        $this->zone = $zone;
    }

    public function getId()
    {
        return $this->id;
    }

   
    public function getName()
    {
        return $this->name;
    }

    public function getOn()
    {
        return $this->on;
    }

    
    public function getModels()
    {
        return $this->model;
    }

    
    public function getWattage()
    {
        return $this->wattage;
    }
    
    public function getZone()
    {
        return $this->zone;
    }

}

?>