<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\SystemConfiguration;
use App\System;
use App\SensorInformation;
use App\Sensor;
use App\BatchInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SensorController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        //bulk update of sensor on configurations page
        if (isset($input['information'])) {

            $validated = $request->validate([
                'information.*.physical_location' => 'required',
                'information.*.max_period_length' => 'required',
                'information.*.max_over_flow_rate' => 'required'
            ]);
                
            foreach($input['information'] as $key => $sensor) {
                SensorInformation::where('id', $key)->update($sensor);
            }
        }

		//cache busting
        Cache::forget('sensor_informations');
        Cache::forget('in_active_sensor_list');
        Cache::forget('active_sensor_list');
        Cache::forget('attached_sensor_list');

        Session::flash('flash_message', 'Sensor successfully saved!');
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
			'total_duration' => 'required|numeric|max:100',
			'dosing_rate' => 'required|numeric',
			'dosing_rate_unit' => 'string',
			'duration_unit' => 'string',
        ]);

        $sensor = SensorInformation::where('sensor_id', '=', $id)->firstOrFail();
        $sensor->update($input);

        if (isset($input['batch_id'])) {
            $batch = BatchInformation::where('batch_id',"=",$input['batch_id'])->first();

            if ($batch) {
                
               $doseEnd =   (\Carbon\Carbon::now());
                $duration = (int)($input['total_duration']);

                switch ($input['duration_unit']) {
                    case 'minutes': {
                        $doseEnd->addMinutes($duration);
                        break;
                    }
                    case 'hours': {
                        $doseEnd->addHours($duration);
                        break;
                    } 
                    case 'days': {
                        $doseEnd->addDays($duration);
                        break;
                    } 
                    case 'months': {
                        $doseEnd->addMonths($duration);
                        break;
                    } 
                    default: {
                        $doseEnd->addSeconds($duration);
                    }
                }

                $batch->dose_end = $doseEnd->format('Y-m-d h:m:s');
                $batch->update();
            }
        }
		
		//cache busting
        Cache::forget('in_active_sensor_list');
        Cache::forget('active_sensor_list');
        Cache::forget('attached_sensor_list');

        Session::flash('flash_message', 'Sensor successfully updated!');

        return redirect('batches/'. $sensor->batch_id);        
    }
	    
}