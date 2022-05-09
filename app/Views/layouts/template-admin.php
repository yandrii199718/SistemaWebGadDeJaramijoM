
<!--
  * Template de administración obtenemos los layouts de todas las paginas
-->

<!-- cabecera de la pagina  -->
<?= $this->include('layouts/header') ?>
<?php
$respuesta = cambiarEstadoVencido();
?>
  <!-- agrego el menu de nuesta página -->
  <?= $this->include('layouts/menu-lateral') ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?= $this->include('layouts/menu-horizontal') ?>

    <!-- mustro todo el contenido que esta en las paginas que contienen este layouts -->
    <?= $this->renderSection("content") ?>

    <?= $this->include('layouts/modal-orden') ?>

<!-- footer de la pagina junto con el cierre y los style -->
<input type="hidden" id="input_rol" value="<?= session('rol') ?>">
<input type="hidden" id="input_rol_a" value="<?= ROL_ADMIN ?>">

<script type="text/javascript">
  rol = <?= json_encode(session('rol')) ?>
</script>
 <?= $this->include('layouts/footer') ?>
