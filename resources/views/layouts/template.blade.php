<!DOCTYPE html>
<html lang="en">
<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<head>
    <title>SYSVET</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistema Online para gestão empresarial de micro e pequenas empresas." />
    <meta name="keywords" content="Sistema Completo para gestão online de micros e pequenas empresas"/>
    <meta name="author" content="John Glauber"/>

    <!-- Favicon icon -->
    <link rel="icon" href="{{url('dattaable/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{url('dattaable/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{url('dattaable/assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{url('dattaable/assets/css/style.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto:300,400,500,600,700" media="all">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- datetimepicker css -->
    <link rel="stylesheet" href="{{url('dattaable/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css')}}">

    <!-- datetimepicker css -->
    <link rel="stylesheet" href="{{url('dattaable/assets/plugins/data-tables/css/datatables.min.css')}}">

    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>


</head>

<body>
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

<!-- [ navigation menu ] start -->
@include('includes.sidebar')
<!-- [ navigation menu ] end -->

<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed bg-white">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
        <a href="index.html" class="b-brand">
            <div class="b-bg">
                <i class="feather icon-trending-up"></i>
            </div>
            <span class="b-title">SYSMAX</span>
        </a>
    </div>
    <a class="mobile-menu" id="mobile-header" href="javascript:">
        <i class="feather icon-more-horizontal"></i>
    </a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
            <li><h6>Empresa: {{\Illuminate\Support\Facades\Auth::user()->Empresa->nome_fantasia}}</h6></li>
            {{--<li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown">Dropdown</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:">Action</a></li>
                    <li><a class="dropdown-item" href="javascript:">Another action</a></li>
                    <li><a class="dropdown-item" href="javascript:">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <div class="main-search">
                    <div class="input-group">
                        <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                        <a href="javascript:" class="input-group-append search-close">
                            <i class="feather icon-x input-group-text"></i>
                        </a>
                        <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                    </div>
                </div>
            </li>--}}
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notificações</h6>
                            <div class="float-right">
                                <a href="javascript:">Limpar Tudo</a>
                            </div>
                        </div>
                        {{--<ul class="noti-body">
                            <li class="n-title">
                                <p class="m-b-0">NEW</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="{{url('dattaable/assets/images/user/avatar-1.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                        <p>New ticket Added</p>
                                    </div>
                                </div>
                            </li>
                            <li class="n-title">
                                <p class="m-b-0">EARLIER</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="{{url('dattaable/assets/images/user/avatar-2.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                        <p>Prchace New Theme and make payment</p>
                                    </div>
                                </div>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="{{url('dattaable/assets/images/user/avatar-3.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                        <p>currently login</p>
                                    </div>
                                </div>
                            </li>
                        </ul>--}}
                        <div class="noti-footer">
                            <a href="javascript:">Mostrar Todas</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon feather icon-settings"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{url('dattaable/assets/images/user/avatar-2.jpg')}}" class="img-radius" alt="User-Profile-Image">
                            <span>{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                            <a  class="dud-logout" title="Logout" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="feather icon-log-out"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{route('empresas.edit', Auth::user()->empresa_id)}}" class="dropdown-item"><i class="feather icon-settings"></i> Configurações</a></li>
                            <li><a href="{{route('users.edit', Auth::user()->empresa_id)}}" class="dropdown-item"><i class="feather icon-user"></i> Perfil</a></li>
                            <li><a href="javascript:" class="dropdown-item"><i class="feather icon-mail"></i> Mensagens</a></li>
                            <li><a href="javascript:" class="dropdown-item"><i class="feather icon-lock"></i> Bloquear</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
               {{-- <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-xs-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Sample Page</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="javascript:">Sample Page</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        @yield('content')
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 11]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade
        <br/>to any of the following web browsers to access this website.
    </p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="{{url('dattaable/assets/images/browser/chrome.png')}}" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="{{url('dattaable/assets/images/browser/firefox.png')}}" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="{{url('dattaable/assets/images/browser/opera.png')}}" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="{{url('dattaable/assets/images/browser/safari.png')}}" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="{{url('dattaable/assets/images/browser/ie.png')}}" alt="">
                    <div>IE (11 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Required Js -->
<script src="{{url('dattaable/assets/js/vendor-all.min.js')}}"></script>
<script src="{{url('dattaable/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('dattaable/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('js/custom.js')}}"></script>

<script src="{{url('dattaable/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js')}}"></script>


<script src="{{url('dattaable/assets/plugins/data-tables/js/datatables.min.js')}}"></script>


{{--<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>



<script>

    $(document).ready( function () {
        $('#myTable').DataTable({
            'bInfo': false,
            'lengthChange': false,
            'language':{
                'sSearch': 'Buscar:',
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Próximo",
                    "sPrevious": "Anterior"
                },
            },

        });
    } );

    $(document).ready( function () {
        $('#myTable3').DataTable({
            'bFilter': false,
            'bInfo': false,
            'bPaginate': false,
        });
    } );

    $(document).ready( function () {
        $('#myTable4').DataTable();
    } );


    function selecionar(){

        $('#produto_id').autocomplete({
            serviceUrl: 'http://localhost/projetos/sysmax/public/product/localizar?q=consulta',
            onSelect: function (suggestion) {
                alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });

    }


    // print button
    function printData() {
        var divToPrint = document.getElementById("printTable").innerHTML;

        var oldPage = document.body.innerHTML;

        //Alterna o body
        document.body.innerHTML =
            "<html><head>  <title></title> </head> <body>  " + divToPrint + "</body>";

        //Imprime o body atual
        window.print();


    }

    $('.btn-print-invoice').on('click', function() {

        document.getElementById('print').style.display = 'none';
        printData();
    });


    $(".cnpj").inputmask({
        mask: "99.999.999/9999-99"
    });

    $(".telefone").inputmask({
        mask: "(99) 99999-9999"
    });


    function pesquisar_cep(){



        var cep = document.getElementById('cep').value;

        var url = 'https://viacep.com.br/ws/' + cep + '/json/';


        $.ajax({
            url: url,
            type: 'GET',

            success: function(data){

                $("#endereco").val(data.logradouro)
                $("#complemento").val(data.complemento)
                $("#bairro").val(data.bairro)
                $("#cidade").val(data.localidade)
                $("#estado").val(data.uf)


            },
            error: function(data){

                alert('Erro ao tentar obter  o cep!')
            }
        });


    }







</script>


@yield('posScript')

</body>
</html>
