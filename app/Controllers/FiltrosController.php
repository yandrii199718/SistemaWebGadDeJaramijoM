<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Equipos;
use App\Models\Cronogramamantenimiento;
use App\Models\Actividad;
use App\Models\Sedes;

class FiltrosController extends BaseController
{
	public function index()
	{
		$data['tipoMantenimiento'] = ['PREVENTIVO','CORRECTIVO','TOTAL'];
		if(session('rol') != ROL_ADMIN)
			$data['sede'] = session('sede');
		return view('admin/filtros', $data);
	}

	public function filter(){
		$data['tipoMantenimiento'] = ['PREVENTIVO','CORRECTIVO','TOTAL'];
		if(session('rol') != ROL_ADMIN)
			$data['sede'] = session('sede');

		$data['old'] = $this->request->getPost();
		$tipoMantenimiento = $this->request->getPost('tipo_mantenimiento');
		$codigo = $this->request->getPost('codigo');
		$idSede = $this->request->getPost('idsede');
		$model = model('Equipos');
		$actividad = model('Actividad');

		$array = [
			"mantenimientos.tipo_mantenimiento" => $tipoMantenimiento,
			'equipos.codigo' => $codigo,
			'equipos.idsede' => $idSede
		];
		//var_dump($data); exit;
		//mantenimientos.tipo_mantenimiento="PREVENTIVO" and equipos.codigo = "001" and idarea = 1

		$resultado = $model->getEquipoFiltro($array);

		//echo "<pre>";
		//var_dump($resultado);
		//exit;

		if($resultado != null){

			//agregar la actividad de cada mantenimiento
			foreach($resultado as $datos){
				//consulta si existen actividades  a este mantenimientos
				$datosActividad = $actividad->where('idMantenimiento', $datos['id_mantenimiento'])->findAll();

				$datos['actividades'] = $datosActividad;

				$newresultado[] = $datos;
			}

			$data['equipoE'] = $model->getEquipos($resultado[0]['id_equipo']);
			$data['datosEquipo'] = $newresultado;
			$cronograma = model('Cronogramamantenimiento');
			$actividad = model('Actividad');
			//$respuestaCronnograma = $cronograma->where(['idmantenimiento' => $resultado[0]['id_mantenimiento']])->findAll();
			foreach($resultado as $key => $datos){
				$respuestaCronnograma[] = $cronograma->getCronogramaOrden(['c.idmantenimiento' => $datos['id_mantenimiento']]);
			}
			$data['datosCronograma'] = $respuestaCronnograma;
			/*
			foreach ($data['datosCronograma'] as $key => $value) {
				echo count($value);
			}
			//var_dump($respuestaCronnograma);
			exit;*/
		}


			return view('admin/filtros', $data);


		//SELECT mantenimientos.actividad, mantenimientos.fecha_mantenimiento, mantenimientos.estado_alerta, mantenimientos.tipo_mantenimiento, equipos.* FROM equipos INNER JOIN mantenimientos ON equipos.id_equipo=mantenimientos.id_mantenimiento WHERE mantenimientos.tipo_mantenimiento="PREVENTIVO" and equipos.codigo="001" and equipos.idarea=1
	}


	//reporte del filtro
	public function reporte($codigo, $idsede, $tipo){
		$sedes = model('Sedes');
		$config = model('Configuracion');
		$model = model('Equipos');
		$actividad = model('Actividad');


		$configuracion = $config->find(1);
		$sede = $sedes->find(session('idsede'));

		$array = [
			"mantenimientos.tipo_mantenimiento" => $tipo,
			'equipos.codigo' => $codigo,
			'equipos.idsede' => $idsede
		];
		//var_dump($data); exit;
		//mantenimientos.tipo_mantenimiento="PREVENTIVO" and equipos.codigo = "001" and idarea = 1

		if(session('rol') != ROL_ADMIN){
			if($idsede == session('idsede')){
				$equipo = $model->getEquipoFiltro($array);
			} else {
				return redirect()->to(base_url().'/reportes');
			}
		} else {
			$equipo = $model->getEquipoFiltro($array);
		}




		//echo "<pre>";
		//var_dump($newresultado);
		//exit;

		if($equipo != null){

			//agregar la actividad de cada mantenimiento
			foreach($equipo as $datos){
				//consulta si existen actividades  a este mantenimientos
				$datosActividad = $actividad->where('idMantenimiento', $datos['id_mantenimiento'])->findAll();

				$datos['actividades'] = $datosActividad;

				$newresultado[] = $datos;
			}

			$equipoE = $model->getEquipos($equipo[0]['id_equipo']);
			$datosEquipo = $newresultado;
			$cronograma = model('Cronogramamantenimiento');
			$actividad = model('Actividad');
			//$respuestaCronnograma = $cronograma->where(['idmantenimiento' => $resultado[0]['id_mantenimiento']])->findAll();
			foreach($equipo as $key => $datos){
				$respuestaCronnograma[] = $cronograma->getCronogramaOrden(['c.idmantenimiento' => $datos['id_mantenimiento']]);
			}
			$datosCronograma = $respuestaCronnograma;
			/*
			foreach ($data['datosCronograma'] as $key => $value) {
				echo count($value);
			}
			//var_dump($respuestaCronnograma);
			exit;*/

			require ROOTPATH. 'vendor/autoload.php';
			include __DIR__.'/reports/reports_filtro.php';

		} else {
			return redirect()->to(base_url().'/reportes');
		}


	}
}
