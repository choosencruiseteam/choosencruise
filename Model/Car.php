<?php
  class Car{

    //Instance variables for Car Model Object
    private $vin;
    private $carlot_id;
    private $carlot_posted_price;
    private $carlot_price_last_updated;
    private $make;
    private $model;
    private $trim;
    private $year;
    private $engine;
    private $transmission;

    //Constructor - An array of the car data from the SQL database will
    // be passed to the contructor.
    public function __construct($carData){
      $this->vin = $carData[0];
      $this->carlot_id = $carData[1];
      $this->carlot_posted_price = $carData[2];
      $this->carlot_price_last_updated = $carData[3];
      $this->make = $carData[4];
      $this->model = $carData[5];
      $this->trim = $carData[6];
      $this->year = $carData[7];
      $this->engine = $carData[8];
      $this->transmission = $carData[9];
    }

    //Accessors
    public function getVin(){ return $this->vin; }
    public function getCarlotId(){ return $this->carlot_id; }
    public function getPostedPrice(){ return $this->carlot_posted_price; }
    public function getPriceLastUpdated(){ return $this->carlot_price_last_updated; }
    public function getMake(){ return $this->make; }
    public function getModel(){ return $this->model; }
    public function getYear(){ return $this->year; }
    public function getTrim(){ return $this->trim; }
    public function getEngine(){return $this->engine; }
    public function getTransmission(){return $this->transmission;}
  }
 ?>
