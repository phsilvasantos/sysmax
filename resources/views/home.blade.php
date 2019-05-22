@extends('layouts.template')

@section('content')

    <div class="row">
        <!-- [ bitcoin-wallet section ] start-->
        <div class="col-md-6 col-xl-4">
            <div class="card theme-bg bitcoin-wallet">
                <div class="card-block" style="padding:30px">
                    <h5 class="text-white mb-2">Clientes</h5>
                    <h2 class="text-white mb-2 f-w-300">{{$clientes}}</h2>
                    {{--<span class="text-white d-block">Ratings by Market Capitalization</span>--}}
                    <i class="fas fa-user f-70 text-white"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card theme-bg2 bitcoin-wallet">
                <div class="card-block" style="padding:30px">
                    <h5 class="text-white mb-2">Vendas</h5>
                    <h2 class="text-white mb-2 f-w-300">{{$vendas}}</h2>
                    {{--<span class="text-white d-block">Ratings by Market Capitalization</span>--}}
                    <i class="fas fa-dollar-sign f-70 text-white"></i>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-4">
            <div class="card bg-c-blue bitcoin-wallet">
                <div class="card-block" style="padding:30px">
                    <h5 class="text-white mb-2">Produtos</h5>
                    <h2 class="text-white mb-2 f-w-300">{{$produtos}}</h2>
                   {{-- <span class="text-white d-block">Ratings by Market Capitalization</span>--}}
                    <i class="fas fa-box f-70 text-white"></i>
                </div>
            </div>
        </div>
        <!-- [ bitcoin-wallet section ] end-->

        <!-- [ statistic-line chat ] start -->
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Faturamento</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div id="line-area2" class="lineAreaDashboard" style="height: 330px; overflow: hidden; text-align: left;"><div class="amcharts-main-div" style="position: relative; width: 100%; height: 100%;"><div class="amChartsLegend amcharts-legend-div" style="overflow: hidden; position: relative; text-align: left; width: 817px; height: 48px;"><svg version="1.1" style="position: absolute; width: 817px; height: 48px; top: 0px; left: 0px;"><desc>JavaScript chart by amCharts 3.21.5</desc><g transform="translate(48,10)"><path cs="100,100" d="M0.5,0.5 L768.5,0.5 L768.5,37.5 L0.5,37.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0"></path><g transform="translate(0,11)"><g cursor="pointer" aria-label="" transform="translate(0,0)"><g><path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#1de9b6"></path><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#000000" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(17,8)"></circle></g><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(76,7)"> </text><rect x="32" y="0" width="60" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect></g><g cursor="pointer" aria-label="" transform="translate(107,0)"><g><path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#10adf5"></path><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#000000" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(17,8)"></circle></g><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(76,7)"> </text><rect x="32" y="0" width="60" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect></g></g></g></svg></div><div class="amcharts-chart-div" style="overflow: hidden; position: relative; text-align: left; width: 817px; height: 282px; padding: 0px; touch-action: auto;"><svg version="1.1" style="position: absolute; width: 817px; height: 282px; top: 0px; left: 0px;"><desc>JavaScript chart by amCharts 3.21.5</desc><g><path cs="100,100" d="M0.5,0.5 L816.5,0.5 L816.5,281.5 L0.5,281.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0"></path><path cs="100,100" d="M0.5,0.5 L768.5,0.5 L768.5,236.5 L0.5,236.5 L0.5,0.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" transform="translate(48,10)"></path></g><g><g transform="translate(48,10)"></g><g transform="translate(48,10)" visibility="visible"><g><path cs="100,100" d="M0.5,236.5 L0.5,236.5 L768.5,236.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000"></path></g><g><path cs="100,100" d="M0.5,189.5 L0.5,189.5 L768.5,189.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000"></path></g><g><path cs="100,100" d="M0.5,142.5 L0.5,142.5 L768.5,142.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000"></path></g><g><path cs="100,100" d="M0.5,94.5 L0.5,94.5 L768.5,94.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000"></path></g><g><path cs="100,100" d="M0.5,47.5 L0.5,47.5 L768.5,47.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000"></path></g><g><path cs="100,100" d="M0.5,0.5 L0.5,0.5 L768.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000"></path></g></g></g><g transform="translate(48,10)" clip-path="url(#AmChartsEl-39)"><g visibility="hidden"><g transform="translate(0,0)" visibility="hidden"><rect x="0.5" y="0.5" width="64" height="236" rx="0" ry="0" stroke-width="0" fill="#000000" stroke="#000000" fill-opacity="0" stroke-opacity="0" transform="translate(-33,0)"></rect></g></g></g><g></g><g></g><g></g><g><g transform="translate(48,10)"><g clip-path="url(#AmChartsEl-42)"><path cs="100,100" d="M32.5,231.78 L96.5,208.18 L160.5,212.9 L224.5,184.58 L288.5,194.02 L352.5,175.14 L416.5,179.86 L480.5,137.38 L544.5,160.98 L608.5,132.66 L672.5,123.22 L736.5,94.9 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#1de9b6" stroke-linejoin="round"></path></g><g clip-path="url(#AmChartsEl-41)"><path cs="100,100" d="M32.5,231.78 L96.5,208.18 L160.5,212.9 L224.5,184.58 L288.5,194.02 L352.5,175.14 L416.5,179.86 L480.5,137.38 L544.5,160.98 L608.5,132.66 L672.5,123.22 L736.5,94.9 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#1de9b6" stroke-linejoin="round"></path></g><clipPath id="AmChartsEl-41"><rect x="0" y="0" width="768" height="236" rx="0" ry="0" stroke-width="0"></rect></clipPath><clipPath id="AmChartsEl-42"><rect x="0" y="236" width="768" height="1" rx="0" ry="0" stroke-width="0"></rect></clipPath><g></g></g><g transform="translate(48,10)"><g clip-path="url(#AmChartsEl-44)"><path cs="100,100" d="M32.5,160.98 L96.5,146.82 L160.5,154.372 L224.5,90.18 L288.5,104.34 L352.5,97.732 L416.5,113.78 L480.5,66.58 L544.5,85.46 L608.5,71.3 L672.5,80.74 L736.5,47.7 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#10adf5" stroke-linejoin="round"></path></g><g clip-path="url(#AmChartsEl-43)"><path cs="100,100" d="M32.5,160.98 L96.5,146.82 L160.5,154.372 L224.5,90.18 L288.5,104.34 L352.5,97.732 L416.5,113.78 L480.5,66.58 L544.5,85.46 L608.5,71.3 L672.5,80.74 L736.5,47.7 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#10adf5" stroke-linejoin="round"></path></g><clipPath id="AmChartsEl-43"><rect x="0" y="0" width="768" height="236" rx="0" ry="0" stroke-width="0"></rect></clipPath><clipPath id="AmChartsEl-44"><rect x="0" y="236" width="768" height="1" rx="0" ry="0" stroke-width="0"></rect></clipPath><g></g></g></g><g></g><g><path cs="100,100" d="M0.5,236.5 L768.5,236.5 L768.5,236.5" fill="none" stroke-width="1" stroke-opacity="0.2" stroke="#000000" transform="translate(48,10)"></path><g><path cs="100,100" d="M0.5,0.5 L768.5,0.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(48,246)"></path></g><g><path cs="100,100" d="M0.5,0.5 L0.5,236.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(48,10)" visibility="visible"></path></g></g><g><g transform="translate(48,10)" clip-path="url(#AmChartsEl-40)" style="pointer-events: none;"><path cs="100,100" d="M0.5,0.5 L768.5,0.5 L768.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" visibility="hidden"></path></g><clipPath id="AmChartsEl-40"><rect x="0" y="0" width="768" height="236" rx="0" ry="0" stroke-width="0"></rect></clipPath></g><g></g><g><g transform="translate(48,10)"><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(32,231)" aria-label=" Jan 5"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(96,208)" aria-label=" Feb 30"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(160,212)" aria-label=" Mar 25"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(224,184)" aria-label=" Apr 55"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(288,194)" aria-label=" May 45"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(352,175)" aria-label=" Jun 65"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(416,179)" aria-label=" Jul 60"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(480,137)" aria-label=" Aug 105"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(544,160)" aria-label=" Sep 80"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(608,132)" aria-label=" Oct 110"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(672,123)" aria-label=" Nov 120"></circle><circle r="4" cx="0" cy="0" fill="#1de9b6" stroke="#1de9b6" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(736,94)" aria-label=" Dec 150"></circle></g><g transform="translate(48,10)"><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(32,160)" aria-label=" Jan 80"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(96,146)" aria-label=" Feb 95"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(160,154)" aria-label=" Mar 87"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(224,90)" aria-label=" Apr 155"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(288,104)" aria-label=" May 140"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(352,97)" aria-label=" Jun 147"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(416,113)" aria-label=" Jul 130"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(480,66)" aria-label=" Aug 180"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(544,85)" aria-label=" Sep 160"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(608,71)" aria-label=" Oct 175"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(672,80)" aria-label=" Nov 165"></circle><circle r="4" cx="0" cy="0" fill="#10adf5" stroke="#10adf5" fill-opacity="1" stroke-width="2" stroke-opacity="0" transform="translate(736,47)" aria-label=" Dec 200"></circle></g></g><g><g></g></g><g><g transform="translate(48,10)" visibility="visible"><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(32,253.5)"><tspan y="6" x="0">Jan</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(96,253.5)"><tspan y="6" x="0">Feb</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(160,253.5)"><tspan y="6" x="0">Mar</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(224,253.5)"><tspan y="6" x="0">Apr</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(288,253.5)"><tspan y="6" x="0">May</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(352,253.5)"><tspan y="6" x="0">Jun</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(416,253.5)"><tspan y="6" x="0">Jul</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(480,253.5)"><tspan y="6" x="0">Aug</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(544,253.5)"><tspan y="6" x="0">Sep</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(608,253.5)"><tspan y="6" x="0">Oct</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(672,253.5)"><tspan y="6" x="0">Nov</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(736,253.5)"><tspan y="6" x="0">Dec</tspan></text></g><g transform="translate(48,10)" visibility="visible"><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,235)"><tspan y="6" x="0">0</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,188)"><tspan y="6" x="0">50</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,141)"><tspan y="6" x="0">100</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,93)"><tspan y="6" x="0">150</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,46)"><tspan y="6" x="0">200</tspan></text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,-1)"><tspan y="6" x="0">250</tspan></text></g></g><g></g><g transform="translate(48,10)"></g><g></g><g></g><clipPath id="AmChartsEl-39"><rect x="-1" y="-1" width="770" height="238" rx="0" ry="0" stroke-width="0"></rect></clipPath></svg><a href="http://www.amcharts.com/javascript-charts/" title="JavaScript charts" style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 53px; top: 15px;">JS chart by amCharts</a></div></div></div>
                </div>
            </div>
        </div>
        <!-- [ statistic-line chat ] end -->

        <!-- [ notifications section ] start -->
        <div class="col-xl-4 col-md-12">
            <div class="card note-bar">
                <div class="card-header">
                    <h5>Ultimas Vendas</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card-block p-0">

                    @forelse($ultimasVendas as $venda)
                        <a href="{{route('vendas.edit', $venda->id)}}" class="media friendlist-box">
                            <div class="mr-3 photo-table">
                                <i class="far fa-bell f-30"></i>
                            </div>
                            <div class="media-body">
                                <h6>{{$venda->Cliente->nome}}</h6>
                                <span class="f-12 float-right text-muted">{{$venda->total_venda_liquido}}</span>
                                <p class="text-muted m-0">{{$venda->status}}</p>
                            </div>
                        </a>
                    @empty
                        <div style="padding:50px" align="center">
                            <i class="fa fa-shopping-cart f-70"></i>
                            <p></p>
                            <h6>Sem novas vendas no momento!</h6>
                        </div>

                    @endforelse

                </div>
            </div>
        </div>
        <!-- [ notifications section ] end-->


    </div>

@endsection
