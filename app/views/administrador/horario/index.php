<?php $this->layout('administrador/layouts/app') ?>

<?php $this->start('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle de la hora</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-1">
                    <form id="myForm" action="<?= URL . 'horarios/store' ?>" method="POST">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="id_especialista" id="id_especialista" value="<?= $id_especialista ?>">
                        <div class="mb-1">
                            <label for="nombre" class="form-label">Día</label>
                            <select class="form-control" name="nombre" id="nombre" required>
                                <option value="">seleccionar</option>
                                <option value="Domingo">Domingo</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="hora_inicio_m" class="form-label">Turno mañana</label>
                            <input type="text" id="hora_inicio_m" name="hora_inicio_m" class="form-control mb-1" data-provider="timepickr" data-default-time="8:00" placeholder="00:00" required>
                            <input type="text" id="hora_fin_m" name="hora_fin_m" class="form-control mb-1" data-provider="timepickr" data-default-time="12:00" placeholder="00:00" required>
                        </div>
                        <div class="mb-1">
                            <label for="nombre" class="form-label">Turno tarde</label>
                            <input type="text" id="hora_inicio_t" name="hora_inicio_t" class="form-control mb-1" data-provider="timepickr" data-default-time="14:00" placeholder="00:00" required>
                            <input type="text" id="hora_fin_t" name="hora_fin_t" class="form-control mb-1" data-provider="timepickr" data-default-time="18:00" placeholder="00:00" required>
                        </div>
                        <div class="mb-1">
                            <label for="nombre" class="form-label">Estado</label>
                            <input type="checkbox" class="form-check-input" name="estado" id="estado">
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
                <h4 class="mb-sm-0">Modulo de Horarios</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <a onclick="Nuevo(<?= $id_especialista  ?>);" class="btn btn-primary w-25">Nuevo hora</a>
                        <select class="form-control" onchange="redirigir(this.value)">
                            <option value="">Selecciona un especialista </option>
                            <?php foreach ($especialista as $row) : ?>
                                <option value="<?= $row['id'] ?>" <?= ($id_especialista == $row['id']) ? 'selected' : '' ?>><?= $row['nombres'] . ' ' . $row['apellidos'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <a id="guardarCambiosBtn" class="btn btn-primary w-25">Guardar Cambios</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (isset($_COOKIE['mensaje'])) : ?>
                        <div id="msj">
                            <div id="mensaje" class="alert alert-info mt-1">
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
                                document.getElementById('msj').innerHTML = '';
                            }, 6000);
                        </script>
                    <?php endif; ?>
                    <table id="example" class="table  dt-responsive nowrap table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">DIA</th>
                                <th data-ordering="false">ESTADO</th>
                                <th data-ordering="false">TURNO MAÑANA</th>
                                <th data-ordering="false">TURNO TARDE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="updateForm" method="POST" action="<?= URL . 'horarios/update' ?>">
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                                        <td> <?= $row['nombre'] ?></td>
                                        <td>
                                            <div class="form-check form-switch form-switch-md text-center" dir="ltr">
                                                <input type="hidden" name="estado[<?= $row['id'] ?>]" value="0">
                                                <input type="checkbox" class="form-check-input" <?= ($row['estado'] == 1) ? 'checked' : '' ?> name="estado[<?= $row['id'] ?>]" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="hora_inicio_m[]" data-provider="timepickr" data-default-time="<?= $row['hora_inicio_m'] ?>">
                                                <input type="text" class="form-control" name="hora_fin_m[]" data-provider="timepickr" data-default-time="<?= $row['hora_fin_m'] ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="hora_inicio_t[]" data-provider="timepickr" data-default-time="<?= $row['hora_inicio_t'] ?>">
                                                <input type="text" class="form-control" name="hora_fin_t[]" data-provider="timepickr" data-default-time="<?= $row['hora_fin_t'] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop('contenido') ?>
<?php $this->start('script') ?>
<script src="assets/libs/@simonwep/pickr/pickr.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/form-pickers.init.js"></script>

<script>
    function redirigir(valor) {
        if (valor !== "") {
            window.location.href = "horarios?code=" + valor;
        }
    }

    function Nuevo(id) {
        if (id > 0) {
            $('#myForm')[0].reset();
            $('#id').val(0);
            $('#staticBackdrop').modal('show');
            return;
        }
        event.preventDefault();
        alert('selecciona un especialista');
    }
    document.getElementById("guardarCambiosBtn").addEventListener("click", function() {
        var form = document.getElementById("updateForm");
        var formData = new FormData(form);
        // Envío de datos mediante AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                if (response) {
                    alert('datos actualizado correctamente');
                    return
                }
                alert('error al actualizar');
            }
        };
        xhr.send(formData);
    });
</script>
<?php $this->stop('script') ?>