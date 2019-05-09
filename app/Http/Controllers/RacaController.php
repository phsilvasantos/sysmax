<?php

namespace App\Http\Controllers;

use App\Models\Racas\Raca;
use Illuminate\Http\Request;
use DB;

class RacaController extends AppController
{
    //
    public $model = Raca::class;

    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('racas')
            ->where($select, $value)
            //->groupBy($dependent)
            ->get();
        $output = '<option value="">Selecione uma '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
}
