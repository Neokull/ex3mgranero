<?php
require_once "autoload.php";

class lamp{
    protected $id;
    protected $name;
    protected $state;
    protected $domain;
    protected $power;
    protected $zone;

    function __construct($id, $name, $state, $domain, $power, $zone){
        $this->id = $id;
        $this->name = $name;
        $this->state = $state;
        $this->domain = $domain;
        $this->power = $power;
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

    public function getState()
    {
        return $this->state;
    }

    
    public function getDomain()
    {
        return $this->domain;
    }

    
    public function getPower()
    {
        return $this->power;
    }

    
    public function getZone()
    {
        return $this->zone;
    }

}

?>