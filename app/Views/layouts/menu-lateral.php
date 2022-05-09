<!-- Sidebar -->
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>V-Dashboard</title>
  <meta property="og:image" content="https://og-image.vercel.app/V-Dashboard.png" />
</head>
    <!-- Sidebar - Brand -->
    <ul class="navbar-nav bg-gradient-primary color-navbar sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand h-auto p-2" href="<?= base_url().route_to('login.index') ?>">
        <div class="sidebar-brand-icon"><!-- class="rotate-n-15" -->
            <!--<i class="fas fa-laugh-wink"></i>-->
            <div class="logo" width="25%">
          <span class="align-middle">SISGEM GAD DE JARAMIJO</span>
            </div>

        </div>
        <!--<div class="sidebar-brand-text mx-3"><?= session('sede') ?></div>-->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- inicio -->
    <li class="nav-item <?= service('request')->uri->getPath() == '/' || service('request')->uri->getPath() == 'admin' ? 'active': '' ?>">
        <a class="nav-link" href="<?= base_url().route_to('login.index') ?>">
            <i class="fas fa-laptop-house"></i>
            <span>Inicio</span></a>
    </li>

    <?php if(session('rol') == ROL_ADMIN): ?>
    <!-- usuarios -->
    <li class="nav-item <?= service('request')->uri->getPath() == 'usuarios' ? 'active': '' ?>">
        <a class="nav-link " href="<?= base_url().route_to('usuarios.index') ?>">
            <i class="fas fa-user"></i>
            <span>Usuarios</span></a>
    </li>
    <?php endif; ?>

    <!-- clientes -->
    <li class="nav-item <?= service('request')->uri->getPath() == 'provedor' ? 'active': '' ?>">
        <a class="nav-link" href="<?= base_url().route_to('provedor.index') ?>">
            <i class="fas fa-user-friends"></i>
            <span>Proveedores</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>



    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= service('request')->uri->getPath() == 'reportes' ? 'active': '' ?>">
        <a class="nav-link" href="<?= base_url().route_to('filtros.index') ?>">
            <i class="fas fa-file"></i>
            <span>Reportes</span>
        </a>
    </li>
    <?php if(session('rol') == ROL_ADMIN): ?>
    <li class="nav-item <?= service('request')->uri->getPath() == 'marcas' || service('request')->uri->getPath() == 'areas' || service('request')->uri->getPath() == 'cargos' || service('request')->uri->getPath() == 'cites' ? 'active': '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-cogs"></i>
            <span>Configuración</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url().route_to('sedes.index') ?>">Dependencias</a>
                <a class="collapse-item" href="<?= base_url().route_to('cargos.index') ?>">Cargos</a>
                <a class="collapse-item" href="<?= base_url().route_to('areas.index') ?>">Areas</a>
                <a class="collapse-item" href="<?= base_url().route_to('marcas.index') ?>">Marcas</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= service('request')->uri->getPath() == 'equipos' || service('request')->uri->getPath() == 'herramientas' ? 'active': '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-folder"></i>
            <span>Inventario</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url().route_to('herramientas.index') ?>">Software</a>
                <a class="collapse-item" href="<?= base_url().route_to('equipos.index') ?>">Equipos</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        <?= (session('rol') == ROL_ADMIN) ? 'Mantenimientos' : 'Ordenes' ?>

      </div>

      <!--<li class="nav-item <?= service('request')->uri->getPath() == '' ? 'active': '' ?>">
          <a class="nav-link" href="<?= base_url().route_to('prueba-calendar.index') ?>">
              <i class="fas fa-calendar-alt"></i>
              <span>Calendario Mantenimiento</span>
          </a>
      </li>-->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?= service('request')->uri->getPath() == 'mantenimiento' ? 'active': '' ?>">
          <a class="nav-link" href="<?= base_url().route_to('mantenimientos.index') ?>">
              <i class="fas fa-tools"></i>
              <span>Mantenimiento</span>
          </a>
      </li>


    <!-- Nav Item - Charts -->
    <li class="nav-item <?= service('request')->uri->getPath() == 'ordenes' ? 'active': '' ?>">
        <a class="nav-link" href="<?= base_url().route_to('ordenes.index') ?>">
            <i class="fas fa-clipboard-check"></i>
            <span>Mantenimiento Finalizado</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
