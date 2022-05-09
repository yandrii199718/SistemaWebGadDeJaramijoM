<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>

<?= $this->section('style') ?>

<link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- calendario -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/libs/calendario/calendario2.css" />
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/card.css" />
    <link rel="shortcut icon" type="imagen/png" href="/assets/img/template/logo2.ico" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<?= $this->endSection() ?>
<?= $this->section("content") ?>



  <!-- content -->
  
  
  <div class="bg-primary pt-10 pb-21"></div>
            <div class="container-fluid mt-n22 px-6">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-2 mb-lg-0">
                                    <h3 class="mb-0  text-white">Tablero</h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
    <div class="card bg-light">         
           <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                    <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Equipos registrado</div>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-laptop-house fs-4"></i>
                                    </div>
                                    </div>
                                    <div>
                                    <h1  class="h5 mb-0 font-weight-bold"><?= $equipos ?></h1>
                                   
                                </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">

    <div class="card bg-light ">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- heading -->
                                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                                    <div>
                                    <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Provedores registrados</div>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-user-friends fs-4"></i>
                                    </div>
                                </div>
                                <!-- project number -->
                                <div>
                                    <h1 class="h5 mb-0 font-weight-bold"><?= $provedores ?></h1>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
    
    <div class="card bg-light">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- heading -->
                                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                                    <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Tareas Planificadas</div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-calendar-check fs-4"></i>
                                    </div>
                                </div>
                                <!-- project number -->
                                <div>
                                    <h1 class="h5 mb-0 font-weight-bold" id="tareasPlanificadas"><?= $amounPreventivo ?></h1>
                                </div>
                            </div>
                        </div>

                    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">

    <div class="card bg-light">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- heading -->
                                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                                   <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Tareas No planificadas</div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-calendar-times fs-4"></i>
                                    </div>
                                </div>
                                <!-- project number -->
                                <div>
                                    <h1 class="h5 mb-0 font-weight-bold" id="tareasNoPlanificadas"><?= $amounCorrectivo ?></h1>
                                </div>
                            </div>
                       
                    </div>
                </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
    
    <div class="card bg-light">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- heading -->
                                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Mantenimientos Generados</div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-clipboard-list fs-4"></i>
                                    </div>
                                </div>
                                <!-- project number -->
                                <div>
                                    <h1 class="h5 mb-0 font-weight-bold" id="otcreadas"><?= $amountCronograma['total'] ?></h1>
                                </div>
                            </div>
                        </div>
                </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
    
    <div class="card bg-light">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- heading -->
                                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Mantenimientos Pendientes</div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-exclamation-triangle fs-4"></i>
                                    </div>
                                </div>
                                <!-- project number -->
                                <div>
                                    <h1 class="h5 mb-0 font-weight-bold" id="otpendientes"><?= $amountCronograma['pendientes'] ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
    

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">

    <div class="card bg-light">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- heading -->
                                <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div class="text-xs font-weight-bold text-secundary text-uppercase mb-1">
                            Mantenimientos Finalizadas</div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                                        <i class="fas fa-clipboard-check fs-4"></i>
                                    </div>
                                </div>
                                <!-- project number -->
                                <div>
                                    <h1 class="h5 mb-0 font-weight-bold" id="otfinalizadas"><?= $amountCronograma['finalizados'] ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
    

  </div>

    </div>

    <!--<div class="col-12 col-md-6">
      <div class="card card-danger">
                <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card card-danger">
                <canvas id="myChartBar" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
    </div>-->
    <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="card bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Cronograma tareas</h6>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="card card-danger bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Cronograma Mantenimiento</h6>
                            </div>
                            <canvas id="myChartBar"></canvas>
                        </div>
                    </div>
                </div>
                
            </div>
           
          
                            
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

					



      

<?= $this->endSection() ?>

<?= $this->section('script') ?>
  <!-- calendario -->
  <script src="/assets/libs/calendario/calendario.js"></script>
  <script src="/assets/ajax/orden.js"></script>

  <script>

  ajaxCronograma();

//diagrama de pastel Tareas planificadas vs no planificadas
tareasPlanificadas = $('#tareasPlanificadas').html();
tareasNoPlanificadas = $('#tareasNoPlanificadas').html();
cronogramaTareas = [tareasPlanificadas,tareasNoPlanificadas];


var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Tareas Planificadas('+tareasPlanificadas+')', 'Tareas no planificadas('+tareasNoPlanificadas+')'],
        datasets: [{
            label: '# of Votes',
            data: cronogramaTareas,
            backgroundColor: [
                'rgba(18, 150, 250, .8)',
                'rgba(254, 93, 80, .8)',
            ],
            borderColor: [
                'rgba(18, 150, 250, 1)',
                'rgba(254, 93, 80, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

creadas = $('#otcreadas').html();
pendiente = $('#otpendientes').html();
finalizado = $('#otfinalizadas').html();

cronograma = [creadas,pendiente,finalizado];
// diagrama de barras
var ctxBar = document.getElementById('myChartBar').getContext('2d');
var myChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Creadas('+creadas+')', 'Pendientes('+pendiente+')', 'Finalizado('+finalizado+')'],
        datasets: [{
            label: 'Estados cronograma',
            data: cronograma,
            backgroundColor: [
                'rgba(18, 150, 250, 0.8)',
                'rgba(119, 39, 191, 0.8)',
                'rgba(254, 93, 80, 0.8)',
            ],
            borderColor: [
                'rgba(18, 150, 250, 1)',
                'rgba(119, 39, 191, 1)',
                'rgba(254, 93, 80, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script type="text/javascript">
/*
obtengo el numero de semana
 */
/*
function getWeekNr(){
	var now=new Date();
  var i=0;
  var f;
  // si dia 1 es mayour a 0 entonces pinta 1 caso contrario pinta 0
  var sem=(new Date(now.getFullYear(), 0,1).getDay()>0)?1:0; // = 1;

  //array de semanas pertenecen a un mes

	while( (f=new Date(now.getFullYear(), 0, ++i)) < now ){
    // el conteo es de 0 a 6 en el cual 0 es falso y siempre que hay un cero ingresa al if
		if(!f.getDay()){

			sem++;
		}
	}
	return sem - 1;
}
alert(getWeekNr());*/
</script>


<?= $this->endSection() ?>
