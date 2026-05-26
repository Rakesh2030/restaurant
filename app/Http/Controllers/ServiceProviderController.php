<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Greeting;

class ServiceProviderController extends Controller
{
    //
    public function index(Greeting $greeting){
        return $greeting->sayHello();
    }
}
