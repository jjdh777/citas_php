 <!doctype html>
 <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

 <head>
     <meta charset="utf-8" />
     <title>Sign In | Velzon - Admin & Dashboard Template</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
     <meta content="Themesbrand" name="author" />
     <!-- App favicon -->
     <link rel="shortcut icon" href="<?= URL ?>assets/images/logo-light.png" />
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
     <!-- auth-page wrapper -->
     <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
         <div class="bg-overlay"></div>
         <!-- auth-page content -->
         <div class="auth-page-content overflow-hidden pt-lg-5">
             <div class="container">
                 <div class="row d-flex justify-content-center">
                     <div class="col-lg-6">
                         <div class="card overflow-hidden">
                             <div class="row g-0">
                                 <div class="col-lg-12">
                                     <div class="p-lg-5 p-4">
                                         <div>
                                             <h4 class="text-primary bold"> <b>Registrate !!</b> </h4>
                                         </div>
                                         <div class="mt-4">
                                             <form action="<?= URL . 'login/registrar' ?>" method="POST">
                                                 <div class="mb-1">
                                                     <label for="dni" class="form-label">DNI</label>
                                                     <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" class="form-control" name="dni" id="dni" required>
                                                 </div>
                                                 <div class="mb-1">
                                                     <label for="nombres" class="form-label">Nombres</label>
                                                     <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese su nombre" required>
                                                 </div>
                                                 <div class="mb-1">
                                                     <label for="apellidos" class="form-label">Apellidos</label>
                                                     <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>
                                                 </div>
                                                 <div class="mb-1">
                                                     <label for="" class="form-label">Genero</label>
                                                     <div class="">
                                                         <input type="radio" class="mx-1" name="genero" id="genero_m" value="Masculino " required> <label for="genero_m">Masculino</label>
                                                         <input type="radio" class="mx-1" name="genero" id="genero_f" value="Femenino" required> <label for="genero_f">Femenino</label>
                                                     </div>
                                                 </div>
                                                 <div class="mb-1">
                                                     <label for="telefono" class="form-label">Telefono</label>
                                                     <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" class="form-control" name="telefono" id="telefono" required>
                                                 </div>
                                                 <div class="mb-1">
                                                     <label for="email" class="form-label">Correo</label>
                                                     <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su email" required>
                                                 </div>
                                                 <div class="mb-3">
                                                     <div class="float-end">
                                                         <a href="auth-pass-reset-cover.html" class="text-muted">olvidaste contraseña ?</a>
                                                     </div>
                                                     <label class="form-label" for="password-input">Contraseña</label>
                                                     <div class="position-relative auth-pass-inputgroup mb-3">
                                                         <input type="password" name="contrasenia" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                         <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                     </div>
                                                 </div>

                                                 <?php if (isset($_COOKIE['mensaje'])) : ?>
                                                     <div class="alert alert-danger mt-1">
                                                         <?= $_COOKIE['mensaje'] ?>
                                                     </div>
                                                 <?php endif; ?>
                                                 <div class="mt-4">
                                                     <button type="submit" class="btn btn-primary w-100">Registrarse </button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- footer -->
         <footer class="footer">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="text-center">
                             <p class="mb-0">&copy;
                                 <script>
                                     document.write(new Date().getFullYear())
                                 </script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </footer>
         <!-- end Footer -->
     </div>
     <!-- end auth-page-wrapper -->

     <!-- JAVASCRIPT -->
     <script src="<?= URL ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="<?= URL ?>assets/libs/simplebar/simplebar.min.js"></script>
     <script src="<?= URL ?>assets/libs/node-waves/waves.min.js"></script>
     <script src="<?= URL ?>assets/libs/feather-icons/feather.min.js"></script>
     <script src="<?= URL ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
     <script src="<?= URL ?>assets/js/plugins.js"></script>

     <!-- password-addon init -->
     <script src="<?= URL ?>assets/js/pages/password-addon.init.js"></script>
 </body>

 </html>