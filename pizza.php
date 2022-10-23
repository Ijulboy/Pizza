<?php

abstract class Pizza {

public $id;
public $name;
public $price;

public function __construct($name="Вы не выбрали пиццу", $price=0, $id=0){
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
}

abstract function view ();
}

class Pizza_Check extends Pizza{
    
    function view (){
        echo "Пицца: ".$this->name."<br>";
    }
}

?>