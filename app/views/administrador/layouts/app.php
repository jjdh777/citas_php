<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
  <meta charset="utf-8" />
  <title>Centro de Psicoterapia Integral Crecer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="Centro de Psicoterapia Integral Crecer" name="description" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= URL ?>assets/images/logo-light.png" />
  <?php echo $this->section('style'); ?>
  <!-- jsvectormap css -->
  <link href="<?= URL ?>assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
  <!-- Layout config Js -->
  <script src="<?= URL ?>assets/js/layout.js"></script>
  <!-- Bootstrap Css -->
  <link href="<?= URL ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="<?= URL ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="<?= URL ?>assets/css/app.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php
  $cadenaDesencriptada = openssl_decrypt($_COOKIE["usuario"], 'AES-256-CBC', 'clave_secreta');
  $usuario = unserialize($cadenaDesencriptada);
  ?>
  <!-- Begin page -->
  <div id="layout-wrapper">
    <?php include_once 'header.php' ?>
    <?php include_once 'sidebar.php' ?>
    <div class="main-content">
      <div class="page-content">
        <?php echo $this->section('contenido'); ?>
      </div>
      <?php include_once 'footer.php' ?>
    </div>
  </div>
  <!-- END layout-wrapper -->

  <!--start back-to-top-->
  <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
  </button>
  <!--end back-to-top-->

  <!--preloader-->
  <div id="preloader">
    <div id="status">
      <div class="spinner-border text-primary avatar-sm" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>

  <div class="customizer-setting d-none ">
    <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
      <i class="mdi mdi-spin mdi-cog-outline fs-22"></i>
    </div>
  </div>


  <!-- JAVASCRIPT -->
  <script src="<?= URL ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= URL ?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= URL ?>assets/libs/node-waves/waves.min.js"></script>
  <script src="<?= URL ?>assets/libs/feather-icons/feather.min.js"></script>
  <script src="<?= URL ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="<?= URL ?>assets/js/plugins.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    const datatableEs = {
      "processing": "Procesando...",
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "emptyTable": "Ningún dato disponible en esta tabla",
      "info": "Mostrando del _START_ al _END_ de total _TOTAL_ registros",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "search": "Buscar:",
      "infoThousands": ",",
      "loadingRecords": "Cargando...",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    }
  </script>

  <?php echo $this->section('script'); ?>
  <!-- App js -->
  <script src="<?= URL ?>assets/js/app.js"></script>
</body>

</html>