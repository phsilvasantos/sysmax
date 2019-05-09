<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itens\Item;

class ItemController extends AppController
{
    //
    public $model = Item::class;

    public function destroy($id)
    {

        $registro = $this->model::where('id',$id)->get()[0];

        $registro->delete();

        response()->json(['success' => 'success'], 200);


    }

    public function store(Request $request)
    {
        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();

        return response()->json(['success' => 'success', 'item_id' => $registro->id], 200);
    }

    public function update(Request $request, $id)
    {
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));

        response()->json(['success' => 'success'], 200);
    }




}
