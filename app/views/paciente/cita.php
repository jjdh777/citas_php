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
        <i class="bx bxs-star"></i> Hola: <strong><?= $usuario['nombres'] ?></strong> Registra tu Cita Aquí
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="myForm" action="<?= URL . 'miscitas/crearcitas' ?>" method="POST">
                        <input type="hidden" name="id_paciente" id="id_paciente" value="<?= $usuario['id'] ?>">
                        <div class="mb-1">
                            <label for="descripcion" class="form-label">Escriba una descripción breve de la cita </label>
                            <textarea class="form-control" maxlength="80" name="descripcion" id="descripcion" rows="1" required></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="id_especialidad" class="form-label">Especialidad</label>
                            <select class="form-control" onchange="buscarPsicologo(this.value,`<?= URL . 'especialistas/getByEspecialidad' ?>`)" name="id_especialidad" id="id_especialidad" required>
                                <option value="">Seleccione especialidad</option>
                                <?php foreach ($especialidad as $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="id_especialista" class="form-label">Especialista</label>
                            <select onchange="buscarDia(this.value)" class="form-control" name="id_especialista" id="id_especialista" required>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="fecha_cita" class="form-label">Fecha de la cita</label>
                            <input type="date" onchange="buscarHoras(this.value,`<?= URL . 'citas/validarHoras' ?>`)" class="form-control" name="fecha_cita" id="fecha_cita" id="fecha" name="fecha" required>
                        </div>
                        <div class="alert alert-danger d-flex align-items-center d-none " role="alert">
                            <i class="mdi mdi-message-alert-outline me-2 fs-3"></i>
                            Horas no disponibles del Especialista. Elija otro Especialista.
                        </div>
                        <div class="mb-1">
                            <label for="hora_cita" class="form-label">Hora de la cita</label>
                            <select class="form-control" name="hora_cita" id="hora_cita" required>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1 float-end">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop('contenido') ?>
<?php $this->start('script') ?>
<script>
    let psicologo_ = 0;

    function Nuevo() {
        $('#myForm')[0].reset();
        $('#id').val(0);
        $('#genero_f').attr('checked', false);
        $('#genero_m').attr('checked', false);
    }

    function buscarPsicologo(id_especialidad, url) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response) {
                        const data = JSON.parse(response);
                        let html = '<option  > Seleccione un Especialistas</option>';
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
        if (psicologo_ == 0) {
            $('#fecha_cita').val('');
            alert('Selecciona un Especiaista')
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
                                console.log();
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
        xhr.send("id_especialista=" + encodeURIComponent(psicologo_) + "&fecha=" + encodeURIComponent(fecha));
    }

    function buscarDia(id_especialista) {
        psicologo_ = id_especialista;
    }
</script>
<?php $this->stop('script') ?>