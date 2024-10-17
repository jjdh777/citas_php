<?php
$routes = [
    // url => [controller, action]
    '' => ['HomeController', 'index'],
    'home' => ['HomeController',  'index'], 

    'miscitas' => ['PacienteviewController','index'],
    'miscitas/citas' => ['PacienteviewController','citas'],
    'miscitas/crearcitas' => ['PacienteviewController','crearcitas'],

    'usuario' => ['UsuarioController', 'index'],
    'usuario/store' => ['UsuarioController', 'store'],
    'usuario/destroy' => ['UsuarioController', 'destroy'],

    'citas' => ['CitaController', 'index'],
    'citas/store' => ['CitaController', 'store'],
    'citas/destroy' => ['CitaController', 'destroy'],
    'citas/validarHoras' => ['CitaController', 'validarHoras'],
    'citas/actualizarEstado' => ['CitaController', 'actualizarEstado'],

    'pacientes' => ['PacienteController', 'index'],
    'pacientes/store' => ['PacienteController', 'store'],
    'pacientes/destroy' => ['PacienteController', 'destroy'],

    'especialistas' => ['EspecialistaController', 'index'],
    'especialistas/store' => ['EspecialistaController', 'store'],
    'especialistas/destroy' => ['EspecialistaController', 'destroy'],
    'especialistas/getByEspecialidad' => ['EspecialistaController', 'getByEspecialidad'],

    'especialidades' => ['EspecialidadController', 'index'],
    'especialidades/store' => ['EspecialidadController', 'store'],
    'especialidades/destroy' => ['EspecialidadController', 'destroy'],

    'horarios' => ['HorarioController', 'index'],
    'horarios/store' => ['HorarioController','store'],
    'horarios/update' => ['HorarioController','update'],
    'horarios/destroy' => ['HorarioController','destroy'],
    'horarios/getDias' => ['HorarioController','getDias'],

    'login' => ['LoginController', 'index'],
    'login/register' => ['LoginController', 'register'],
    'login/iniciarsesion' => ['LoginController', 'iniciarsesion'],
    'login/cerrarsesion' => ['LoginController', 'cerrarsesion'],
    'login/registrar' => ['LoginController', 'registrar'],
];
