<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tienda</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
     

    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    
     <!-- jQuery 2.1.4 -->
     <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
     @stack('script')
     
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
   
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
   
    
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
      <style>
        
        .filterIcon {
            height: 16px;
            width: 16px;
        }

        .modalFilter {
            display: none;
            height: auto;
            background: #FFF;
            border: solid 1px #ccc;
            padding: 8px;
            position: absolute;
            z-index: 1001;
        }

            .modalFilter .modal-content {
                max-height: 250px;
                overflow-y: auto;
            }

            .modalFilter .modal-footer {
                background: #FFF;
                height: 35px;
                padding-top: 6px;
            }

            .modalFilter .btn {
                padding: 0 1em;
                height: 28px;
                line-height: 28px;
                text-transform: none;
            }

        #mask {
            display: none;
            background: transparent;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            opacity: 1000;
        }
    </style>
   

  </head>
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper.collapse.in">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>TD</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>TIenDA</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a> 
          <div class="col-lg-10 col-md-10 col-xs-10">
          <div class="form-group">
            <h4 style="margin-bottom:-4px ; margin-top:8px ;font-size:25px; color:#fff">@yield('titulo')  </h4>
          </div>
       </div>   
             
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" >
            <li class="header"></li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Stock</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="/stock/stock"><i class="fa fa-circle-o"></i> Stock</a></li>
                <li><a href="/stock/producto"><i class="fa fa-circle-o"></i> BD Productos</a></li>
               
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/compra/pedidos"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                <li><a href="/compra/orden"><i class="fa fa-circle-o"></i> Ordenes</a></li>
                <li><a href="/compra/detalleorden"><i class="fa fa-circle-o"></i> Listado de Compras</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/ventas/venta"><i class="fa fa-circle-o"></i> Venta por Cliente</a></li>
                <li><a href="/ventas/venta/create"><i class="fa fa-circle-o"></i> Nueva Venta</a></li>             
                <li><a href="/ventas/detalleventa"><i class="fa fa-circle-o"></i> Listado Ventas</a></li>                
                <li><a href="/ventas/cliente"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>

              </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
           <div class="row">
            <div class="col-md-12">
              @yield('actualizacion')
                            
              <div class="panel panel-default">                
                <div class="panel-body">
                  	<div class="row">
	                  	<div class="col-md-12">		                         
                              <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017-2022 Wedelia</a>.</strong> All rights reserved.
      </footer>
    </div>


    
    
    
  </body>
</html>
