<?php
    declare(strict_types=1);
    class item {
        private $name, $price, $link;        
        function _constructor(string $name, double $price, string $link){
            $this->name = $name;
            $this->price = $price;
            $this->link = $link;
        }
        function getName(){
            
            return $this->name;
        }
        function getPrice(){
            return $this->price;
        }
        function getLink(){
            return $this->link;
        }
        function setName($name){
            $this->name =$name;
            
        }
        function setPrice($price){
            $this->price = $price;
        }
        function setLink($link){
            $this->link = $link;
        }
        
    }
    if(isset($_POST[])){

    }
    





?>