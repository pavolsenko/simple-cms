<?php

namespace App\Sensor;

interface SensorRepositoryInterface {
    public function saveSensorData($input);
    public function getAllSensorData();
}
