 <?php $this->layout('administrador/layouts/app') ?>

 <?php $this->start('contenido') ?>
 <div class="container-fluid">
     <!-- start page title -->
     <div class="row">
         <div class="col-12">
             <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                 <h4 class="mb-sm-0">Menu</h4>
             </div>
         </div>
     </div>
     <!-- end page title -->
     <?php
        $cadenaDesencriptada = openssl_decrypt($_COOKIE["usuario"], 'AES-256-CBC', 'clave_secreta');
        $usuario = unserialize($cadenaDesencriptada);
        ?>
     <div class="alert   " style="background-color: #7C3AED ; color:aliceblue;border-radius:8px;" role="alert">
         <i class="bx bxs-star"></i> Bienvenido: <strong><?= $usuario['nombres'] ?></strong>
     </div>
     <div>
         <div class="d-flex justify-content-center gap-3 mb-2">
             <div class="form-check card-radio shadow  ">
                 <label class="form-check-label bg-success-500" for="listGroupRadioGrid1">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avatar-xs">
                                 <div class="avatar-title bg-soft-success text-success fs-18 rounded">
                                     <i class="mdi mdi-account-multiple-outline"></i>
                                 </div>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-1"> <b>Total de Pacientes</b> </h6>
                             <b class="pay-amount fs-5 "><?= $pacientes ?></b>
                         </div>
                     </div>
                 </label>
             </div>
             <div class="form-check card-radio shadow">
                 <label class="form-check-label" for="listGroupRadioGrid2">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avatar-xs">
                                 <div class="avatar-title bg-soft-info text-info fs-18 rounded">
                                     <i class="mdi mdi-account-multiple-outline"></i>
                                 </div>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-1"> <b>Total de Especialistas</b> </h6>
                             <b class="pay-amount fs-5"><?= $especialistas ?></b>
                         </div>
                     </div>
                 </label>
             </div>
             <div class="form-check card-radio shadow">
                 <label class="form-check-label" for="listGroupRadioGrid3">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avatar-xs">
                                 <div class="avatar-title bg-soft-danger text-danger fs-18 rounded">
                                     <i class="mdi mdi-clipboard-list-outline"></i>
                                 </div>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-1"> <b>Total de Citas</b> </h6>
                             <b class="pay-amount fs-5"><?= $citas ?></b>
                         </div>
                     </div>
                 </label>
             </div>
         </div>
     </div>

     <div class="row">
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-header">
                     <h5 class="card-title mb-0"> <b>Los utimos pacientes registrados</b> </h5>
                 </div>
                 <div class="card-body">
                     <table id="example" class="table   dt-responsive nowrap table-striped align-middle" style="width: 100%">
                         <thead>
                             <tr>
                                 <th data-ordering="false">PACIENTES</th>
                                 <th data-ordering="false">TELEFONO</th>
                                 <th data-ordering="false">EMAIL</th>
                                 <th data-ordering="false">REGISTRO</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $meses = array(
                                    1 => 'Enero',
                                    2 => 'Febrero',
                                    3 => 'Marzo',
                                    4 => 'Abril',
                                    5 => 'Mayo',
                                    6 => 'Junio',
                                    7 => 'Julio',
                                    8 => 'Agosto',
                                    9 => 'Septiembre',
                                    10 => 'Octubre',
                                    11 => 'Noviembre',
                                    12 => 'Diciembre'
                                );
                                ?>
                             <?php foreach ($data as $row) : ?>
                                 <tr>
                                     <td><?= $row['nombres'] ?> <?= $row['apellidos'] ?></td>
                                     <td><?= $row['telefono'] ?> </td>
                                     <td><?= $row['email'] ?> </td>
                                     <td>
                                         <?= date("d, ", strtotime($row['created_at'])) . $meses[date("n", strtotime($row['created_at']))] . date(" Y", strtotime($row['created_at'])); ?>
                                     </td>
                                 </tr>
                             <?php endforeach ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <?php $this->stop('contenido') ?>

 <?php $this->start('script') ?>

 <?php $this->stop('script') ?>