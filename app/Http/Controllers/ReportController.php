<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\StatTrack;
use App\Models\ShotChart;
use App\Models\TeamPlayer;

class ReportController extends Controller
{
    public function index(){

      return view('reports/index');
    }
}
