@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">
                <h5>Fluxo de Caixa</h5>
                <div class="card-header-right">

                    <a href="{{route('receber.create')}}" ><button type="button" class="btn btn-primary btn-sm btn-rounded">+ Nova</button></a>



                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable9">
                        <thead>
                        <tr>

                            <th>Tipo</th>
                            <th>Conta</th>
                            <th>Vencimento</th>


                        </tr></thead>
                        <tbody>



                            @foreach($registros as $conta)

                            <tr>
                                <td style="padding-left:10px;"> {{ $conta->categoria_type }} </td>
                                <td style="padding-left:10px;"> {{ $conta->categoria }} </td>
                                <td> {{$conta->categoria_type == 'Pagar' ? $conta->valor * -1 : $conta->valor}} </td>


                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
