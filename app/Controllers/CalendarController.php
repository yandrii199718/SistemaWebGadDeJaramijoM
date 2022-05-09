<?php


namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Calendar;

class CalendarController extends BaseController
{
    public function index()
    {
        return view('admin/prueba-calendar');
    }
