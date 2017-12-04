<?php
class Item {
        private $name, $price, $link;
        function __construct(string $name, float $price, string $link){
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
        function toString(){
            return $this->name.",".$this->price.",".$this->link;
        }
    }
?>