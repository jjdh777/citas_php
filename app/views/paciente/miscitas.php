<?php $this->layout('administrador/layouts/app') ?>

<?php $this->start('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<?php $this->stop('style') ?>
<?php $this->start('contenido') ?>
<div class="container-fluid">
    <?php
    $cadenaDesencriptada = openssl_decrypt($_COOKIE["usuario"], 'AES-256-CBC', 'clave_secreta');
    $usuario = unserialize($cadenaDesencriptada);
    ?>
    <div class="alert   " style="background-color: #7C3AED ; color:aliceblue;border-radius:8px;" role="alert">
        <i class="bx bxs-star"></i> Bienvenido: <strong><?= $usuario['nombres'] ?> <?= $usuario['apellidos'] ?></strong>, estamos muy contentos de ayudarte &#128512
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" id="_botones">
                    <h5 class="card-title mb-1 mx-1">Mis citas</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">PACIENTE</th>
                                <th data-ordering="false">DESCRIPCION</th>
                                <th data-ordering="false">EPECIALISTA</th>
                                <th data-ordering="false">ESPECIALIDAD</th>
                                <th data-ordering="false">FECHA</th>
                                <th data-ordering="false">HORA INICIO</th>
                                <th>ESTADO</th>
                                <th style="width: 1%;">ACCION</th>
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
                            <?php foreach ($citas as $row) : ?>
                                <tr>
                                    <td><?= $row['nombre_paciente']; ?> <?= $row['apellidos_paciente']; ?></td>
                                    <td style="padding: 0;"> <textarea class="form-control border-0 m-0 p-0" rows="1"> <?= $row['descripcion']; ?></textarea> </td>
                                    <td><?= $row['nombre_especialista']; ?> <?= $row['apellidos_especialista']; ?></td>
                                    <td><?= $row['nombre_especialidad']; ?></td>
                                    <td>
                                        <?= date("d, ", strtotime($row['fecha_cita'])) . $meses[date("n", strtotime($row['fecha_cita']))] . date(" Y", strtotime($row['fecha_cita'])); ?>
                                    </td>
                                    <td><?= $row['hora_cita']; ?></td>
                                    <td>
                                        <?php if ($row['estado'] == 'pendiente') : ?>
                                            <span class="badge badge-label bg-warning"><i class="mdi mdi-circle-medium"></i> <?= $row['estado']; ?> </span>
                                        <?php elseif ($row['estado'] == 'aceptado') : ?>
                                            <span class="badge badge-label bg-success"><i class="mdi mdi-circle-medium"></i> <?= $row['estado']; ?> </span>
                                        <?php else : ?>
                                            <span class="badge badge-label bg-danger"><i class="mdi mdi-circle-medium"></i> <?= $row['estado']; ?> </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['estado'] == 'pendiente') : ?>
                                            <a href="<?= URL . 'citas/destroy?id=' . $row['id'] ?>"><i class="mdi mdi-delete-forever-outline fs-4 text-primary"></i></a>
                                        <?php endif; ?>
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
<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"> </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"> </script>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true,
            paging: true,
            language: datatableEs,
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'Example',
                    className: 'btn btn-primary mx-1 btn-expo'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'btn btn-primary mx-1 btn-expo'
                }
            ]
        });
        $('#_botones').append(table.buttons().container()).find('.btn-expo').unwrap();
        document.querySelector('.dt-button.buttons-excel.buttons-html5').classList.remove('dt-button', 'buttons-excel', 'buttons-html5');
        document.querySelector('.dt-button.buttons-pdf.buttons-html5').classList.remove('dt-button', 'buttons-pdf', 'buttons-html5');
    });
</script>
<?php $this->stop('script') ?>