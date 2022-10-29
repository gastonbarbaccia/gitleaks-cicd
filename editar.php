<?php
include "conexiondb.php";

$id = $_GET['id'];

$mysqli = conexiondb();

$resultado = $mysqli->query("SELECT * FROM productos WHERE id LIKE '$id'");

$fila = $resultado->fetch_assoc();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Trabajo Practico N°1 </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
  @media (min-width: 576px) {
    .col-sm-ggb {
      flex: 0 0 50% !important;
      max-width: 45% !important;
    }
  }

  .form-control {
    width: 200% !important;
  }

  #divs-juntos {
    float: left;
  }

  .table thead th {
    vertical-align: baseline;
  }

  .text-nowrap {
    white-space: normal !important;
  }

  .form-control-ggb {
    width: 500% !important;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>



    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <a href="index.php" class="brand-link">
        <img src="dist/img/tsystems.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Trabajo Practico</span>
      </a>


      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Stock
                </p>
              </a>
            </li>
          </ul>
        </nav>

      </div>

    </aside>


    <div class="content-wrapper">


      <section class="content">


        <div class="card-header">
          <h3 class="card-title"><b>Editar producto</b></h3>
        </div>


        <div class="card-body" style="width: 40% !important;">
          <?php

          // Se crea un formuario del tipo POST y como action se configura el archivo actualizar.php
          // mediante este form se envian los datos a actualizar en la base de datos filtrando por id

          ?>
          <form name="nuevo" method="post" action="actualizar.php" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $fila['id'] ?>" hidden>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-ggb col-form-label">Producto:</label>
              <div class="col-sm-3">
                <input type="text" class="form-control-ggb form-control" id="producto" name="producto" value="<?php echo $fila['producto'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-ggb col-form-label">Cantidad:</label>
              <div class="col-sm-3">
                <input type="text" class="form-control-ggb form-control" id="cantidad" name="cantidad" value="<?php echo $fila['cantidad'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-ggb col-form-label">Precio: </label>
              <div class="col-sm-3">
                <input type="text" class="form-control-ggb form-control" id="precio" name="precio" value="<?php echo $fila['precio'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-ggb col-form-label">Imagen actual:</label>
              <div class="col-sm-3">
                <?php

                if ($fila['ruta_imagen'] == '') {
                ?>

                    <input type="text" class="form-control-ggb form-control" value="Actualmente no cuenta con imagen" readonly>
                 

                <?php
                }else{
                ?>
   
                  <a href="<?php echo $fila['ruta_imagen'] ?>" target="blank"><img src="<?php echo $fila['ruta_imagen'] ?>" width="350" height="200"></a>
               
              
                <?php

                }

                ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-ggb col-form-label">Imagen nueva</label>
              <div class="col-sm-3">
                <input type="file" class="form-control-ggb form-control" id="archivo" name="archivo" accept="image/jpeg">
              </div>
            </div>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="margin-left: 115%">
                <div style="padding-right: 4%;">
                  <a class="btn btn-primary" style="width: 100%;background-color:red;border-color:red;color:white" href="index.php">Cancelar</a>
                </div>
                <div>
                  <button class="btn btn-primary" style="width: 100%;background-color:green;border-color:green;color:white" type="submit">Guardar</button>
                </div>
              </div>
            </div>

        </div>

    </div>
    <!-- /.card -->
  </div>
  </div>

  </section>

  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="https://www.t-systems.com.ar" style="color: deeppink"> T-Systems</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>V.</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>
