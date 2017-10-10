<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @yield('metas')

        <title>@yield('title','Supremie POS')</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                /*margin: 0;*/
                min-height: 500px;
                /*padding-top: 30px;*/
            }
            body #app_content{
                padding-top: 67px;

            }
            .dataTables_wrapper{
                color: black;
                font-family: 'Arial', sans-serif;
                font-weight: 80;                
                font-size: 20px;
                /*height: 100vh;*/
            }
            ul#details li {
                display:inline;
            }
            ul#details li  span{
                color: red;
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Supremie</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav" id="nav">
                <li><a href="/">Home</a></li>
                <li><a href="{{route('orders.index')}}">Orders</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stocks
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('drink.index')}}">Drink</a></li>
                        <li><a href="{{route('mie.index')}}">Mie</a></li>
                        <li><a href="{{route('topping.index')}}">Topping</a></li>
                    </ul>
                </li>
                <li><a href="{{route('kitchen.orders')}}">Kitchen</a></li>
                <li><a href="{{route('cashier.orders')}}">Cashier</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('reports.order')}}">Order</a></li>
                        <li><a href="{{route('reports.sales_drink')}}">Sales Drink</a></li>
                        <li><a href="{{route('reports.sales_mie')}}">Sales Mie</a></li>
                        <li><a href="{{route('reports.mie')}}">Mie</a></li>
                        <li><a href="{{route('reports.drink')}}">Drink</a></li>
                    </ul>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right hidden">
                <li><a href="../navbar/">Default</a></li>
                <li class="active"><a href="./">Static top <span class="sr-only">(current)</span></a></li>
                <li><a href="../navbar-fixed-top/">Fixed top</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
        <div class="container">
            @includeif('layouts.alert')
        </div>
        <div id="app_content">
            @yield('contents')            
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script><!-- App scripts -->
        <script>
            $(function(){
                $('.picker').datepicker({
                    format: 'yyyy-mm-dd'
                });
                var current = location.pathname;
                $('#nav li').each(function(){
                    var $this = $(this).find('a');
                    // if the current path is like this link, make it active
                    // console.log($this.attr('href').substring($this.attr('href').indexOf(location.origin)));
                    if($this.attr('href').replace(location.origin,'')==current){
                        if($this.parents('li.dropdown').length)
                            $this.parents('li.dropdown').addClass('active');
                        $(this).addClass('active');
                    }
                })
            })
            
        </script>
        @stack('scripts')
    </body>
</html>
