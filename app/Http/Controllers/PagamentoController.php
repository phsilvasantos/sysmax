<?php

namespace App\Http\Controllers;

use App\Models\Pagamentos\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends AppController
{
    //
    public $model = Pagamento::class;

    public function destroy($id)
    {

        $registro = $this->model::where('id',$id)->get()[0];

        $registro->delete();

        response()->json(['success' => 'success'], 200);


    }

    public function update(Request $request, $id)
    {
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));

        response()->json(['success' => 'success'], 200);
    }
}
