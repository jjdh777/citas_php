<div class="app-menu navbar-menu">
  <div class="navbar-brand-box">
    <!-- Dark Logo-->
    <a href="<?= URL . 'home' ?>" class="logo logo-dark">
      <span class="logo-sm">
        <!-- <img src="assets/images/logo-sm.png" alt="" height="22" /> -->
      </span>
      <span class="logo-lg">
        <img src="assets/images/logo-dark.png" alt="" style="background-size: cover" height="35" />
      </span>
    </a>
    <!-- Light Logo-->
    <a href="<?= URL . 'home' ?>" class="logo logo-light">
      <span class="logo-sm">
        <img src="assets/images/logo-light.png" alt="" height="22" />
      </span>
      <span class="logo-lg">
        <img src="assets/images/logo-light.png" alt="" height="35" />
      </span>
    </a>
    <button type="button" class="btn btn-sm  p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
      <i class="ri-record-circle-line "></i>aaaa
    </button>
  </div>
  <div id="scrollbar">
    <div class="container-fluid">
      <div id="two-column-menu"></div>
      <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
        <?php if ($usuario['rol'] == 'Administrador') : ?>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'home' ?>">
              <i class="mdi mdi-home-outline"></i>
              <span data-key="t-Inicio">Inicio</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'citas' ?>">
              <i class="mdi mdi-clipboard-text-outline"></i>
              <span data-key="t-Citas">Citas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'usuario' ?>">
              <i class="mdi mdi-account-multiple-outline"></i>
              <span data-key="t-Usuario">Usuarios</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'especialidades' ?>">
              <i class="mdi mdi-tag-outline"></i>
              <span data-key="t-Especialidades">Especialidades</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'especialistas' ?>">
              <i class="mdi mdi-account-multiple-outline"></i>
              <span data-key="t-Especialistas">Especialistas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'pacientes' ?>">
              <i class="mdi mdi-account-multiple-outline"></i>
              <span data-key="t-Pacientes">Pacientes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'horarios' ?>">
              <i class="mdi mdi-calendar-text-outline"></i>
              <span data-key="t-Horarios">Horarios</span>
            </a>
          </li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'miscitas' ?>">
              <i class="mdi mdi-calendar-text-outline"></i>
              <span data-key="t-Horarios">Mis Citas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-link" href="<?= URL . 'miscitas/citas' ?>">
              <i class="mdi mdi-calendar-text-outline"></i>
              <span data-key="t-Horarios">Agenda una cita</span>
            </a>
          </li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
          <li class="nav-item"> <a class="nav-link menu-link"></a></li>
        <?php endif ?>
      </ul>
    </div>
    <div class=" mt-5 d-flex justify-content-center " style="bottom: 4px;">
      <a class="logo logo-light">
        <span class="logo-lg">
          <img src="assets/images/giftbox.png" alt="" height="80" />
        </span>
      </a>
    </div>
  </div>
  <div class="sidebar-background"></div>
</div> 
<div class="vertical-overlay"></div>