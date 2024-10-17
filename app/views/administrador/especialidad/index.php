<?php $this->layout('administrador/layouts/app') ?>

<?php $this->start('style') ?>  
    <link rel="stylesheet"  href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> 
    <link rel="stylesheet"  href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" /> 
<?php $this->stop('style') ?> 
<?php $this->start('contenido') ?>  
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle de especialidad</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-1"> 
            <form id="myForm" action="<?= URL.'especialidades/store' ?>" method="POST">
                <input type="hidden" name="id" id="id">  
                <div class="mb-1">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control"  name="nombre" id="nombre" placeholder="Ingrese un especialidad" required>
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
                <h4 class="mb-sm-0">Modulo de registros de ESPECALIDADES</h4> 
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
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr> 
                                <th data-ordering="false">#</th>
                                <th data-ordering="false">ESPECALIDAD</th>   
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php foreach ($data as $row) : ?> 
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nombre']; ?></td>  
                                    <td> 
                                        <a href="javascript:void(0)" onclick="Editar(<?= htmlspecialchars(json_encode($row)) ?>);" ><i class="mdi mdi-pencil-outline fs-4 text-primary"></i></a> 
                                        <a href="<?= URL.'especialidades/destroy?id='.$row['id']?>"><i class="mdi mdi-delete-forever-outline fs-4 text-primary"></i></a>
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
                language: datatableEs, 
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        title: 'Reporte especialidad',
                        className: 'btn btn-primary mx-1 btn-expo'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        title: 'Reporte especialidad',
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
 