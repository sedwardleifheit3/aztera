<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\SystemConfiguration;
use App\System;
use App\SensorInformation;
use App\Sensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ConfigurationController extends Controller
{
	//@todo make it sure that this is the user's system config
	//@since system table has no user_id yet, leave it this way

	const CORE_SYSTEM_ID = 1;

	public function index()
	{	
		
		//get from memcached

		$system = Cache::remember('system_configurations', 60, function() {
			$system = SystemConfiguration::find(self::CORE_SYSTEM_ID);		
			return  (empty($system) === false) ? $system->toArray() : [] ;				
		});
	
		
		
		//get from memcached
		$sensors = Cache::remember('sensor_informations', 60, function() {
			return Sensor::select(DB::raw('sensor_informations.*, sensor_types.name AS sensor_type_name, sensor_states.id AS sensor_state_id, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description'))
			->leftJoin('sensor_informations', 'sensor_informations.sensor_id', '=', 'sensors.id')
			->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
			->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
			->get()->toArray();     				
		});
		
        $sensors = Sensor::select(DB::raw('sensor_informations.*, sensor_types.name AS sensor_type_name, sensor_states.id AS sensor_state_id, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description'))
        ->leftJoin('sensor_informations', 'sensor_informations.sensor_id', '=', 'sensors.id')
        ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
        ->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
        ->get()->toArray();     
		

		return view('configuration.index', compact([
				'system',
				'sensors'
			])
		);
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
		$validate = $request->validate([
			'recording_interval' => 'required|integer',
			'language' => 'required|string',
			'dosing_point_gateway' => 'required|string',
			'dosing_point_subnet_mask' => 'required|string',					
		]);	

		SystemConfiguration::create($input);		
		
		//cache busting
		Cache::forget('system_configurations');

        Session::flash('flash_message', 'Configuration successfully saved!');
        return redirect()->route('configurations');        
    }
	
	/**
	 * Update
	 * 
	 * @param Request $request
	 * @param [type] $id
	 * @return void
	 */
    public function update(Request $request, $id)
    {
        $input = $request->all();
				
        $validate = $request->validate([
			'recording_interval' => 'sometimes|integer',
			'language' => 'sometimes|string',
			'dosing_point_gateway' => 'sometimes|string',
			'dosing_point_subnet_mask' => 'sometimes|string',					
        ]);

        $configs = SystemConfiguration::findOrFail($id);

        $configs->update($input);
		
		//cache busting
		Cache::forget('system_configurations');

        Session::flash('flash_message', 'Configuration successfully updated!');

        return redirect('configurations');        
    }
	

}