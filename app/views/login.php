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
     <script src="assets/js/layout.js"></script>
     <!-- Bootstrap Css -->
     <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
     <!-- Icons Css -->
     <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <!-- App Css-->
     <link href="assets/css/app.css" rel="stylesheet" type="text/css" />
 </head>

 <body>
     <!-- auth-page wrapper -->

     <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
         <div class="bg-overlay"></div>
         <!-- auth-page content -->
         <div class="auth-page-content overflow-hidden pt-lg-5">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card overflow-hidden">
                             <div class="row g-0">
                                 <div class="col-lg-6">
                                     <div class="p-lg-5 p-4 auth-one-bg h-100" style="background-image: url('assets/images/coming-soon-img.png');">

                                     </div>
                                 </div>

                                 <div class="col-lg-6">
                                     <div class="p-lg-5 p-4">
                                         <div>
                                             <h4 class="text-primary bold"> <b>Iniciar Sesión !!</b> </h4>
                                         </div>
                                         <div class="mt-4">
                                             <form action="<?= URL . 'login/iniciarsesion' ?>" method="POST">
                                                 <div class="mb-3">
                                                     <label for="email" class="form-label"> <b>Usuario</b> <code> <b>*</b> </code> </label>
                                                     <input type="email" class="form-control" id="email" name="email" placeholder="Enter username">
                                                 </div>

                                                 <div class="mb-3">
                                                     <div class="float-end">
                                                         <a href="auth-pass-reset-cover.html" class="text-muted"> <b>olvidaste contraseña ?</b> </a>
                                                     </div>
                                                     <label class="form-label" for="password-input"> <b>Contraseña</b><code> <b>*</b> </code> </label>
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
                                                 <hr class="shadow">
                                                 <div class="mt-4">
                                                     <button class="btn btn-primary  border-1 w-100" type="submit">Acceder</button>
                                                 </div>
                                             </form>
                                         </div>

                                         <div class="mt-5 text-center">
                                             <p class="mb-0">¿ No Tienes una cuenta ? <a href="<?= URL . 'login/register' ?>" class="fw-semibold text-primary text-decoration-underline"> Regístrate</a> </p>
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
     <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="assets/libs/simplebar/simplebar.min.js"></script>
     <script src="assets/libs/node-waves/waves.min.js"></script>
     <script src="assets/libs/feather-icons/feather.min.js"></script>
     <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
     <script src="assets/js/plugins.js"></script>

     <!-- password-addon init -->
     <script src="assets/js/pages/password-addon.init.js"></script>
 </body>

 </html>