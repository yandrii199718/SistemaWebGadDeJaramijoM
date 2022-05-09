<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];
	public $usuario = [
		'usuario'   => 'required|min_length[4]|max_length[20]',
		'password' => 'required|min_length[4]|max_length[20]',
		'dni'   => 'required|numeric|min_length[4]',
		'nombres' => 'required|min_length[4]',
		'telefono'   => 'required|numeric|min_length[4]',
		'email' => 'required|valid_email',
		'idcargo'   => 'required|numeric',
		'idarea' => 'required|numeric',
		'idsede'   => 'required|numeric|is_unique[Usuarios.idsede]',
		'imagen' 	=> 'is_image[imagen]',
	];
	public $usuario_update = [
		'usuario'   => 'required|min_length[4]|max_length[20]',
		'dni'   => 'required|numeric|min_length[4]',
		'nombres' => 'required|min_length[4]',
		'telefono'   => 'required|numeric|min_length[4]',
		'email' => 'required|valid_email',
		'idcargo'   => 'required|numeric',
		'idarea' => 'required|numeric',
		'idsede'   => 'required|numeric',
	];

	//validar el provedores
	public $provedor = [
		'ruc'   => 'required|min_length[10]|max_length[12]',
		'razon_social' => 'required|min_length[4]',
		'rubro'   => 'required|min_length[4]',
		'direccion' => 'required|min_length[4]',
		'telefono'   => 'required|numeric|min_length[6]',
		'contacto'   => 'required',
		'celular' => 'required|numeric',
		'email' => 'required|valid_email',
		'tipo'   => 'required',
	];

	public $areas = [
		'nombre_area'   => 'required|min_length[5]|max_length[50]',
	];

	public $cargos = [
		'nombre_cargo'   => 'required|min_length[5]|max_length[50]',
	];

	public $sedes = [
		'nombre_sede'   => 'required|min_length[5]|max_length[50]',
		'direccion'   => 'required|min_length[5]|max_length[100]',
	];

	public $marcas = [
		'nombre_marca'   => 'required|min_length[2]|max_length[50]',
	];

	public $equipos = [
		'sbn'   => 'required|min_length[2]|max_length[50]',
		'codigo'   => 'is_unique[Equipos.codigo]',
		'nombre_equipo'   => 'required|min_length[5]|max_length[50]',
		'modelo'   => 'required|min_length[2]|max_length[20]',
		'observacion'   => 'max_length[500]',
		'idmarca'   => 'required|numeric',
		'idarea'   => 'required|numeric',
		'imagen' 	=> 'is_image[imagen]',
		//'manual'	=> 'max_size[manual,5024]|ext_in[manual,pdf,docx],',
	];

//'imagen'   => 'uploaded[imagen]|max_size[imagen,1024]',
	public $herramientas = [
		'sbn'   => 'required|min_length[12]|max_length[30]',
		'codigo'   => 'required|is_unique[Herramientas.codigo]',
		'nombre_herramienta'   => 'required|min_length[5]|max_length[50]',
		'idmarca'   => 'required|numeric',
		'idarea'   => 'required|numeric',
		'imagen' 	=> 'is_image[imagen]',
	];




	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
