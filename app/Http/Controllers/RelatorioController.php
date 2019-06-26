<?php

namespace App\Http\Controllers;

use App\Models\Forma_Pagamentos\Forma_Pagamento;
use App\Models\Itens\Item;
use App\Models\Pagamentos\Pagamento;
use App\Models\Vendas\Venda;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class RelatorioController extends AppController
{
    //
    public $model = Venda::class;


    public function caixa(Request $request)
    {
        //



        if ($request->data > 0){

            $registros = $this->model::whereBetween('created_at', [$request->data . ' 00:00:00',$request->data . ' 23:59:59'])
                ->where('status','Quitada')
                ->get();

        }else{

            $registros = $this->model::whereBetween('created_at', [date('Y-m-d') . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])
                ->where('status','Quitada')
                ->get();
        }





        return view('relatorios.caixa', compact('registros'));

    }




}
