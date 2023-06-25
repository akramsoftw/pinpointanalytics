<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Settings index
     */
    public function index()
    {
        return view('settings.index');
    }

    public function logo_upload(Request $request)
    {
        $file = request('file');

        $fileName = $file->hashName();

        Storage::disk('public')->put('settings', $file);

        $saveSetting = Setting::updateOrCreate(
            [
                'setting_name' => 'app_logo',
            ],
            [
            'setting_name' => 'app_logo',
            'setting_value' => $fileName
            ]
        );

        $response = array(
            'msg' => 'success',
            'data' => $saveSetting
        );

        return response()->json($response);
    }

    /**
     * Set stats page dataset
     */
    public function set_dataset(Request $request)
    {
        $this->validate($request, [
            'stats_dataset' => 'required'
        ]);

        $dataset = Setting::updateOrCreate(
            ['setting_name'   => 'stats_dataset'],
            ['setting_value'     => request('stats_dataset')]
        );

        $response = array(
            'msg' => 'success',
            'data' => $dataset,
        );
        return response()->json($response);
    }

    /**
     * Set stat tracker team display
     */
    public function set_stat_tracker_team(Request $request)
    {
        $this->validate($request, [
            'team_select' => 'required'
        ]);

        $dataset = Setting::updateOrCreate(
            ['setting_name'   => 'stat_tracker_team_select'],
            ['setting_value'     => request('team_select')]
        );

        $response = array(
            'msg' => 'success',
            'data' => $dataset,
        );
        return response()->json($response);
    }
}
 