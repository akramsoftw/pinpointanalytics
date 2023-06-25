<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\OptionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PracticeController;

use App\Http\Controllers\ShotChartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatTrackController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\StatsController;

use App\Http\Controllers\AlertController;

use App\Http\Controllers\TeamController;

use App\Http\Controllers\PlayListController;

use App\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect('login');
});

Route::get('/register', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);

    //Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return redirect()->route('shot_chart');
    });

    Route::get('options', [OptionsController::class, 'index'])->name('options_index');
    Route::get('options/game', [OptionsController::class, 'game'])->name('options_game');
    Route::get('options/practice', [OptionsController::class, 'practice'])->name('options_practice');
    Route::get('options/teams', [OptionsController::class, 'teams'])->name('options_teams');
    Route::get('options/players', [OptionsController::class, 'players'])->name('options_players');
    Route::get('options/play-list', [OptionsController::class, 'play_list'])->name('options_play_list');
    Route::post('options/set-session', [OptionsController::class, 'set_session'])->name('options_set_session');

    Route::get('team-create', [TeamController::class, 'create'])->name('team_create');
    Route::post('team-store', [TeamController::class, 'store'])->name('team_store');
    Route::get('team-edit/{id}', [TeamController::class, 'edit'])->name('team_edit');
    Route::post('team-update/{id}', [TeamController::class, 'update'])->name('team_update');
    Route::get('team-show/{id}', [TeamController::class, 'show'])->name('team_show');

    Route::get('player-create/{team_id}', [PlayerController::class, 'create'])->name('player_create');
    Route::post('player-store', [PlayerController::class, 'store'])->name('player_store');
    Route::get('player-edit/{id}', [PlayerController::class, 'edit'])->name('player_edit');
    Route::post('player-update/{id}', [PlayerController::class, 'update'])->name('player_update');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings_index');
    Route::post('logo-upload', [SettingsController::class, 'logo_upload'])->name('settings_logo_upload');
    Route::post('options/set-dataset', [SettingsController::class, 'set_dataset'])->name('options_set_dataset');
    Route::post('options/set-stat-tracker-team', [SettingsController::class, 'set_stat_tracker_team'])->name('options_set_stat_tracker_team');

    Route::get('enable-game/{id}', [GamesController::class, 'enable_game'])->name('enable_game');
    Route::get('game-create', [GamesController::class, 'create'])->name('game_create');
    Route::post('game-store', [GamesController::class, 'store'])->name('game_store');

    Route::get('enable-practice/{id}', [PracticeController::class, 'enable_practice'])->name('enable_practice');
    Route::get('practice-create', [PracticeController::class, 'create'])->name('practice_create');
    Route::post('practice-store', [PracticeController::class, 'store'])->name('practice_store');

    // Play list routes for shot chart
    Route::get('play-create', [PlayListController::class, 'create'])->name('play_create');
    Route::post('play-store', [PlayListController::class, 'store'])->name('play_store');
    Route::get('play-edit/{id}', [PlayListController::class, 'edit'])->name('play_edit');
    Route::post('play-update/{id}', [PlayListController::class, 'update'])->name('play_update');

    // Stat tracker
    Route::get('stat-tracker', [StatTrackController::class, 'index'])->name('stat_tracker');
    Route::post('stat-update', [StatTrackController::class, 'update_stat'])->name('update_stat');

    Route::get('roster', [RosterController::class, 'index'])->name('roster');
    Route::post('roster-init', [RosterController::class, 'init'])->name('roster_init');
    Route::post('roster-filter-change', [RosterController::class, 'filter_change'])->name('roster_filter_change');
    Route::post('roster-filter-game', [RosterController::class, 'roster_filter_game'])->name('roster_filter_game');

    // Stat page
    Route::get('stats', [StatsController::class, 'index'])->name('stats');
    Route::post('stats-live-data', [StatsController::class, 'live_data'])->name('stats_live_data');
    Route::post('stats-all-data', [StatsController::class, 'all_data'])->name('stats_all_data');
    Route::post('shot-live-data', [StatsController::class, 'shot_live_data'])->name('shot_live_data');
    Route::post('shot-all-data', [StatsController::class, 'shot_all_data'])->name('shot_all_data');
    Route::post('stats-filter-change', [StatsController::class, 'filter_change'])->name('stats_filter_change');
    Route::post('stats-advanced-search', [StatsController::class, 'advanced_search'])->name('stats_advanced_search');

    Route::get('users-index', [UserController::class, 'index'])->name('users.index');
    Route::get('users-create', [UserController::class, 'create'])->name('users.create');
    Route::get('users-show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('users-edit/{id}', [UserController::class, 'show'])->name('users.edit');
    Route::post('users-destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users-strore', [UserController::class, 'store'])->name('users.store');

    // Shot chart routes
    Route::get('shot-chart', [ShotChartController::class, 'index'])->name('shot_chart');
    Route::post('update-assigned-user', [ShotChartController::class, 'updateAssignedUser'])->name('update_assigned_user');
    Route::post('record-shot', [ShotChartController::class, 'recordShot'])->name('record_shot');
    Route::post('record-shot-undo', [ShotChartController::class, 'recordShotUndo'])->name('undo_record_shot');
    Route::post('get-shot-analytics', [ShotChartController::class, 'getAnalytics'])->name('get_shot_analytics');


    //Reports Route
    Route::get('reports', [ReportController::class, 'index'])->name('reports_index');
});

// Alerts
Route::get('general-error', [AlertController::class, 'general_error'])->name('general_error');
