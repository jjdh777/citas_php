<?php $this->layout('administrador/layouts/app') ?>

<?php $this->start('style') ?>  
    <link rel="stylesheet"  href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> 
    <link rel="stylesheet"  href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" /> 
    <style> 
        .fade-out {
            opacity: 1;
            animation: fadeOut 8s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
<?php $this->stop('style') ?> 
<?php $this->start('contenido') ?>  
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle del paciente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-1"> 
            <form id="myForm" action="<?= URL.'pacientes/store' ?>" method="POST">
                <input type="hidden" name="id" id="id"> 
                <div class="mb-1">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" class="form-control"  name="dni" id="dni" required> 
                </div>  
                <div class="mb-1">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control"  name="nombres" id="nombres" placeholder="Ingrese su nombre" required>
                </div>  
                <div class="mb-1">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control"  name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>
                </div>   
                <div class="mb-1">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9"  class="form-control" name="telefono" id="telefono" required>
                </div>
                <div class="mb-1">
                    <label for="" class="form-label">Genero</label>
                    <div class=""> 
                        <input type="radio" class="mx-1" name="genero" id="genero_m" value="Masculino " required> <label for="genero-masculino">Masculino</label> 
                        <input type="radio" class="mx-1" name="genero" id="genero_f" value="Femenino" required> <label for="genero-femenino">Femenino</label>
                    </div> 
                </div>
                <div class="mb-1">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control"  name="usuario" id="usuario" placeholder="Ingrese su usuario" required>
                </div>  
                <div class="mb-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su email" required>
                </div>  
                <div class="mb-1">
                    <label for="contrasenia" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Ingrese su contraseña">
                </div>  
              
                <div class="mb-1">
                    <label for="fdn" class="form-label">FDN</label>
                    <input type="text" class="form-control" name="fdn" id="fdn" placeholder="Ingrese su FDN">
                </div>  
              
                <button type="submit" class="btn btn-primary mt-1 float-end">Registrar</button>
            </form>
        </div> 
      </div> 
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Modulo de registros de Pacientes</h4> 
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" id="_botones">
                    <a  onclick="Nuevo();" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Nuevo</a>  
                </div>
                <div class="card-body">
                <?php if (isset($_COOKIE['mensaje'])): ?> 
                    <div id="msj"> 
                        <div id="mensaje" class="alert alert-success mt-1">
                            <?= $_COOKIE['mensaje'] ?>
                        </div>
                    </div> 
                    <script>
                        setTimeout(function() {
                            var mensajeDiv = document.getElementById('mensaje');
                            if (mensajeDiv) {
                                mensajeDiv.classList.add('fade-out'); 
                            }
                        }, 1000);  
                        setTimeout(function() {
                            document.getElementById('msj').innerHTML='';
                        }, 6000);  
                    </script>
                <?php endif; ?>
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr> 
                                <th data-ordering="false">#</th>
                                <th data-ordering="false">PACIENTES</th>  
                                <th data-ordering="false">TELEFONO</th>
                                <th data-ordering="false">SEXO</th>
                                <th data-ordering="false">CORREO</th> 
                                <th data-ordering="false">FDN</th> 
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php foreach ($data as $row) : ?> 
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nombres']; ?> <?= $row['apellidos']; ?></td>  
                                    <td><?= $row['telefono']; ?></td>  
                                    <td><?= $row['genero']; ?></td>  
                                    <td><?= $row['email']; ?></td>  
                                    <td><?= $row['fdn']; ?></td>  
                                    <td> 
                                        <a href="javascript:void(0)" onclick="Editar(<?= htmlspecialchars(json_encode($row)) ?>);" ><i class="mdi mdi-pencil-outline fs-4 text-primary"></i></a> 
                                        <a href="<?= URL.'usuario/destroy?id='.$row['id']?>"><i class="mdi mdi-delete-forever-outline fs-4 text-primary"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop('contenido') ?> 
<?php $this->start('script') ?>
  
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> 
    <script  src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"> </script>
    <script  src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>
    <script  src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>
    <script  src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>
    <script  src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"> </script>  
  
    <script>
        $(document).ready(function() { 
            var table = $('#example').DataTable({ 
                responsive: true,
                paging: true, 
                ordering: false,
                language: datatableEs, 
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        title: 'Reporte paciente',
                        className: 'btn btn-primary mx-1 btn-expo'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        title: 'Reporte paciente',
                        className: 'btn btn-primary mx-1 btn-expo'
                    }
                ]
            }); 
            $('#_botones').append(table.buttons().container()).find('.btn-expo').unwrap(); 
            document.querySelector('.dt-button.buttons-excel.buttons-html5').classList.remove('dt-button', 'buttons-excel', 'buttons-html5');
            document.querySelector('.dt-button.buttons-pdf.buttons-html5').classList.remove('dt-button', 'buttons-pdf', 'buttons-html5');
        }); 
    </script>
    <script>
        function Nuevo() {
            $('#myForm')[0].reset();
            $('#id').val(0);
            $('#genero_f').attr('checked', false);
            $('#genero_m').attr('checked', false); 
        }
        function Editar(params) { 
            Object.entries(params).forEach(function([key, value]) {
                $('#' + key).val(value); 
                if (key=='genero') {  
                    (value=='Femenino')? $('#genero_f').attr('checked', true): $('#genero_m').attr('checked', true); 
                } 
            });
            $('#contrasenia').val(''); 
            $('#staticBackdrop').modal('show');
        }
    </script>
<?php $this->stop('script') ?>
 