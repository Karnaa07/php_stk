<?php

namespace App\Models;

use App\Core\SQL;

class Voyage extends SQL {
    private $title;
    private $description;
    private $destination;
    private $period;
    private $price;
    
    public function __construct($title, $description, $destination, $period, $price) {
        $this->title = $title;
        $this->description = $description;
        $this->destination = $destination;
        $this->period = $period;
        $this->price = $price;
    }
    
    // Getters
    public function getTitle() {
        return $this->title;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getDestination() {
        return $this->destination;
    }
    
    public function getPeriod() {
        return $this->period;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    // Setters
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function setDestination($destination) {
        $this->destination = $destination;
    }
    
    public function setPeriod($period) {
        $this->period = $period;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    
}
