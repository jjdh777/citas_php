<?php $this->layout('administrador/layouts/app') ?>

<?php $this->start('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<?php $this->stop('style') ?>
<?php $this->start('contenido') ?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle de la cita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-1">
                    <form id="myForm" action="<?= URL . 'citas/store' ?>" method="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-1">
                            <label for="descripcion" class="form-label">Escriba una descripción breve de la cita </label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="1"></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="id_paciente" class="form-label">Pacientes</label>
                            <select class="form-control" name="id_paciente" id="id_paciente" required>
                                <option value="">Seleccione paciente</option>
                                <?php foreach ($pacientes as $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nombres'] ?> <?= $row['apellidos'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="id_especialidad" class="form-label">Especialidad</label>
                            <select class="form-control" onchange="buscarEspecialista(this.value,`<?= URL . 'especialistas/getByEspecialidad' ?>`)" name="id_especialidad" id="id_especialidad">
                                <option value="">Seleccione especialidad</option>
                                <?php foreach ($especialidad as $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="id_especialista" class="form-label">Especialista</label>
                            <select onchange="buscarDia(this.value)" class="form-control" name="id_especialista" id="id_especialista">
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="fecha_cita" class="form-label">Fecha de la cita</label>
                            <input type="date" onchange="buscarHoras(this.value,`<?= URL . 'citas/validarHoras' ?>`)" class="form-control" name="fecha_cita" id="fecha_cita" id="fecha" name="fecha">
                        </div>
                        <div class="alert alert-danger d-flex align-items-center d-none " role="alert">
                            <i class="mdi mdi-message-alert-outline me-2 fs-3"></i>
                            Horas no disponibles del Especialista. Elija otro Especialista.
                        </div>
                        <div class="mb-1">
                            <label for="hora_cita" class="form-label">Hora de la cita</label>
                            <select class="form-control" name="hora_cita" id="hora_cita">
                            </select>
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
                <h4 class="mb-sm-0">Modulo de registros de citas</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" id="_botones">
                    <a onclick="Nuevo();" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Nuevo</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">PACIENTE</th>
                                <th data-ordering="false">DESCRIPCION</th>
                                <th data-ordering="false">ESPECIALISTAS</th>
                                <th data-ordering="false">ESPECIALIDAD</th>
                                <th data-ordering="false">FECHA</th>
                                <th data-ordering="false">HORA INICIO</th>
                                <th data-ordering="false">Estado</th>
                                <th>Action</th>
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
                                    <td><?= $row['id']; ?> </td>
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
                                            <a href="<?= URL . 'citas/actualizarEstado?id=' . $row['id'] . '&estado=aceptado' ?>"> <span class="badge badge-soft-success">aceptar</span> </a>
                                            <a href="<?= URL . 'citas/actualizarEstado?id=' . $row['id'] . '&estado=cancelado' ?>"> <span class="badge badge-soft-danger">cancelar</span> </a>
                                        <?php endif; ?>
                                        <a href="<?= URL . 'citas/destroy?id=' . $row['id'] ?>"><i class="mdi mdi-delete-forever-outline fs-4 text-primary"></i></a>
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
            ordering: false,
            language: datatableEs,
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'Reporte Citas',
                    className: 'btn btn-primary mx-1 btn-expo'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    title: 'Reporte Citas',
                    className: 'btn btn-primary mx-1 btn-expo',
                    customize: function(doc) {
                        doc.pageOrientation = 'landscape';
                    }
                }
            ]
        });
        $('#_botones').append(table.buttons().container()).find('.btn-expo').unwrap();
        document.querySelector('.dt-button.buttons-excel.buttons-html5').classList.remove('dt-button', 'buttons-excel', 'buttons-html5');
        document.querySelector('.dt-button.buttons-pdf.buttons-html5').classList.remove('dt-button', 'buttons-pdf', 'buttons-html5');
    });
</script>
<script>
    let especialista_ = 0;

    function Nuevo() {
        $('#myForm')[0].reset();
        $('#id').val(0);
        $('#genero_f').attr('checked', false);
        $('#genero_m').attr('checked', false);
    }

    function buscarEspecialista(id_especialidad, url) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response) {
                        const data = JSON.parse(response);
                        let html = '<option  > Seleccione un Especialista</option>';
                        data.forEach(row => {
                            html += `
                                    <option value="${row.id}"> ${row.nombres} ${row.apellidos}</option>
                                    `;
                        });
                        $('#id_especialista').html(html);
                    } else {
                        alert('Error al actualizar');
                    }
                } else {
                    alert('Error en la solicitud');
                }
            }
        };
        xhr.send("id_especialidad=" + encodeURIComponent(id_especialidad));
    }

    function buscarHoras(fecha, url) {
        if (especialista_ == 0) {
            $('#fecha_cita').val('');
            alert('Selecciona un Especialista')
            return
        }
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response) {
                        if (response == 1) {
                            $('#hora_cita').html('');
                            $('.alert-danger').removeClass('d-none');
                        } else {
                            $('.alert-danger').addClass('d-none');
                            const data = JSON.parse(response);
                            let html = '';
                            for (let i = 0; i < data.length; i++) {
                                html += `
                                        <option value="${data[i].split("-")[0].trim()}">   ${data[i]}</option>
                                        `;
                            }
                            $('#hora_cita').html(html);
                        }
                    } else {
                        alert('Error al actualizar');
                    }
                } else {
                    alert('Error en la solicitud');
                }
            }
        };
        xhr.send("id_especialista=" + encodeURIComponent(especialista_) + "&fecha=" + encodeURIComponent(fecha));
    }

    function buscarDia(id_especialista) {
        especialista_ = id_especialista;
    }
</script>
<?php $this->stop('script') ?>