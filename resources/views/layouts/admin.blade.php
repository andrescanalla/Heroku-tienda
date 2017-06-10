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
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon2.png')}}">
    <link rel="shortcut icon" href="{{asset('img/apple-touch-icon2.png')}}">
     <link rel="icon" href="{{asset('img/apple-touch-icon2.png')}}">

    
     <!-- jQuery 2.1.4 -->
     <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
     @stack('script')
     <script src="{{asset('js/datatables.min.js')}}"></script>
   
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
   
    
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
   

  </head>
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper.collapse.in">

      <header class="main-header">

        <!-- Logo -->
        <a href="/dashboard" class="logo">
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
            
         <div class="col-lg-11 col-md-11 col-xs-11" Style="height:50px; padding-right:0;width:95.5%">
          <div class="form-group" style="margin-bottom:-4px ; margin-top:5px ;font-size:25px; color:#fff">
            @yield('titulo') 
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
              <a href="/stock/stock">
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
                <i class="fa fa-ship"></i>
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
                <i class="fa fa-shopping-bag"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/ventas/venta"><i class="fa fa-circle-o"></i> Ventas por Cliente</a></li>
                <li><a href="/ventas/venta/create"><i class="fa fa-circle-o"></i> Nueva Venta</a></li>             
                <li><a href="/ventas/detalleventa"><i class="fa fa-circle-o"></i> Listado Ventas</a></li>                
              </ul>
            </li>
            <li class="treeview">
              <a href="/ventas/cliente">
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <span>Clientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>                            
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
                            
              <div class="panel panel-default" style="margin-bottom:0">                
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
       <!--<footer class="main-footer" style="padding:8px">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017-2022 Wedelia</a>.</strong> All rights reserved.
      </footer>-->
    </div>


    
    
    @stack('scripts')
  </body>
</html>
