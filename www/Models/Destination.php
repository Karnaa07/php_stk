<?php

namespace App\Models;

use App\Core\SQL;

#Class qui contiendra les méthodes pour récupérer, ajouter, mettre à jour et supprimer des destinations dans la base de données.


class Destination extends SQL{

    private Int $id = 0;
    protected String $name; /*Le nom de la destination de voyage.*/
    protected String $country; /*Le pays dans lequel se trouve la destination.*/
    protected String $city;  /*La ville de la destination.*/
    protected String $description; /*Une description de la destination de voyage.*/
    protected String $price; /*Le prix du voyage vers cette destination.*/
    protected Int $status = 0; /*Status = disponible/indisponible*/


    
    public function __construct($name, $country, $city) {
        $this->name = $name;
        $this->country = $country;
        $this->city = $city;
    }

    //Getters & Setters
    
    public function getName(): string {
        return $this->name;
    }
    
    public function setName($name): void {
        $this->name = $name;
    }
    
    public function getCountry(): string {
        return $this->country;
    }
    
    public function setCountry($country): void {
        $this->country = $country;
    }
    
    public function getCity(): string {
        return $this->ville;
    }
    
    public function setCity($city): void {
        $this->city = $city;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getInformations() {
        return [
            'nom' => $this->name,
            'pays' => $this->country,
            'ville' => $this->city,
            'prix' => $this->price,
            'description' => $this->description,
            
        ];
    }
    
    public function setInformations($informations) {
        if (isset($informations['nom'])) {
            $this->name = $informations['nom'];
        }
        if (isset($informations['pays'])) {
            $this->country = $informations['pays'];
        }
        if (isset($informations['ville'])) {
            $this->city = $informations['ville'];
        }
        
    }


}