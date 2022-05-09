<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar  static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->


    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <a class="navbar-brand"><span>Bienvenido</span> </a>
    
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

    
       

 
  
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?= session('nombres') ?>
                </span>
                <img class="img-profile rounded-circle"
                    src="<?php
                    if(session('imagen') == 'no_image.jpg'){
                      $imagen = URL_UPLOADS.'usuarios/0/'.session('imagen');
                    } else {
                      $imagen = URL_UPLOADS.'usuarios/'.session('id').'/'.session('imagen');
                    }
                    echo $imagen;
                    ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/perfil">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <?php if(session('rol') == ROL_ADMIN): ?>
                <a class="dropdown-item" href="<?= base_url().route_to('configuracion.index') ?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuración
                </a>
              <?php endif; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/signout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>
        

    </ul>

</nav>
<!-- End of Topbar -->
