<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SensorCommand;
use App\SensorInformation;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Auth;

class SensorCommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validated = $request->validate([
            'sensor_id' => 'required',
            'command_type' => 'required',
            'user_id' => 'required',
        ]);

        $data = [
            'user_id' => $input['user_id'],
            'sensor_command_type_id' => $input['command_type'],
            'sensor_id' => $input['sensor_id'],
            'transmitted' => now(),
            "value" => $input['command_type']
        ];
            
        $sensorCommand = SensorCommand::create($data);    

        //if in local and staging env
        //simulate the changing of sensor status
        if (strpos(\Request::root(), 'comingsoon.zone') !== false || strpos(\Request::root(), 'aztera.local')) {
            $sensorState = 1;
        
            if ($input['command_type'] == 4) {
                $sensorState = 2;
            } else if ($input['command_type'] == 6) {
                $sensorState = 3;
            }
                
            SensorInformation::where('sensor_id', $input['sensor_id'])->update(['state_id' => $sensorState]);
        }

        Cache::forget('attached_sensor_list');

        return $sensorCommand;        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
