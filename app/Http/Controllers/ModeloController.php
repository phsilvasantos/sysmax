<?php

namespace App\Http\Controllers;

use App\Models\Modelos\Modelo;
use Illuminate\Http\Request;

class ModeloController extends AppController
{

    public $model = Modelo::class;
}
