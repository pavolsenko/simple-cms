<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as View;

class homeController extends Controller
{

    protected $view;

    public function __construct(View $view) {
        $this->view = $view;
    }


    public function index() {
        return $this->view->make('home');
    }

}
