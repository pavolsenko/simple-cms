<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use App\Sensor\SensorRepositoryInterface;

class SensorController extends Controller {

    private $request;
    private $response;
    private $sensor;

    public function __construct(Request $request, Response $response, SensorRepositoryInterface $sensor) {
        $this->request = $request;
        $this->response = $response;
        $this->sensor = $sensor;
    }

    public function sendData() {

        $input = $this->request->input();

        if (!empty($input["sensor_id"]) && !empty($input["sensor_value"])) {
            $data = [
                "sensor_id" => $input["sensor_id"],
                "sensor_value" => $input["sensor_value"],
            ];
            $this->sensor->saveSensorData($data);
        }

        return $this->response->json([
            'status' => 'success',
            'data' => $this->sensor->getAllSensorData(),
        ]);
    }

}
