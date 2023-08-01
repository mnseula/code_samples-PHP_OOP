<?php
class Car {
    private $make;
    private $model;
    private $year;

    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    public function getMake() {
        return $this->make;
    }

    public function getModel() {
        return $this->model;
    }

    public function getYear() {
        return $this->year;
    }

    public function start() {
        return "The {$this->year} {$this->make} {$this->model} is starting.";
    }
}

$myCar = new Car('Toyota', 'Corolla', 2022);
echo $myCar->start(); // Output: "The 2022 Toyota Corolla is starting."
?>
