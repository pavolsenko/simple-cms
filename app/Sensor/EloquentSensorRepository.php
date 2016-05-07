<?php

namespace App\Sensor;


class EloquentSensorRepository implements SensorRepositoryInterface {

    private $sensor;

    public function __construct(Sensor $sensor) {
        $this->sensor = $sensor;
    }

    public function saveSensorData($input)
    {
        $this->sensor->sensor_id = $input["sensor_id"];
        $this->sensor->sensor_value = $input["sensor_value"];
        $this->sensor->save();
    }

    public function getAllSensorData() {
        $sensors = $this->sensor->get();
        if (!is_null($sensors)) {
            $sensors = $sensors->toArray();
        }
        return $sensors;
    }

}