<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>

<?= $this->section('style') ?>

<link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- calendario -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/libs/calendario/calendario2.css" />

<?= $this->endSection() ?>
<?= $this->section("content") ?>


<div class="container-fluid">
      
    <div class="calendar">
                            
                            <div class="dates">
                            <div class="  month ">
                            <a  href="javascript:void(0);"><i class="fas fa-arrow-circle-left prev"></i></a>
                  <div class="date">
                    <h1></h1>
                    <p></p>
                  </div>
                  <a  href="javascript:void(0);"><i class="fas fa-arrow-circle-right next"></i></a>
                </div>
<div class="weekdays">
    <ul>
        <li>Sun</li>
        <li>Mon</li>
        <li>Tue</li>
        <li>wed</li>
        <li>thu</li>
        <li>Fri</li>
        <li>Sat</li>
    </ul>
</div>


<div class="days">

</div>

<div class="current-data">
<h2>Calendario Año 2022</h2>
</div>


                            </div>

                            <div class="events">
    <div class="profile">
    </div>
    <div class="title">
   <h5> Mantenimientos Planificados </h5>
    
        </div>  
        <div id="eventos"></div>
    </div>
</div>                   

</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
  <!-- calendario -->
  <script src="/assets/libs/calendario/calendario.js"></script>
  <script src="/assets/ajax/orden.js"></script>

  <script>

  ajaxCronograma();


  </script>

<?= $this->endSection() ?>
