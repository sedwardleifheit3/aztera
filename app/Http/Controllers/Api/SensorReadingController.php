<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SensorReading;
use Illuminate\Support\Facades\DB;

class SensorReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();

        //default dates
        $dateStart = isset($params['start_date']) ? $params['start_date'] : (\Carbon\Carbon::now()->subDays(7))->format('Y-m-d');
        $dateEnd  = isset($params['end_date']) ? $params['end_date'] : (\Carbon\Carbon::now())->format('Y-m-d');
        $field  = isset($params['field']) ? $params['field'] : 'dosing_point';
        
        $sensorReading = SensorReading::select(DB::raw('dosing_rate AS field_name, created_at'));

        if ( $field == "dosed_amount") {
            $sensorReading = SensorReading::select(DB::raw('dosed_amount AS field_name, created_at'));
        } elseif ($field == "temperature") {
            $sensorReading = SensorReading::select(DB::raw('temperature AS field_name, created_at'));
        } elseif ($field == "inlet_pressure") {
            $sensorReading = SensorReading::select(DB::raw('inlet_pressure AS field_name, created_at'));
        } elseif ($field == "outlet_pressure") {
            $sensorReading = SensorReading::select(DB::raw('outlet_pressure AS field_name, created_at'));
        }
        
        $sensorReading->whereBetween('created_at', [ $dateStart, $dateEnd ]);

        if (isset($params['sensor_id'])) {
            $sensorReading->where('sensor_id',"=", $params['sensor_id']);
        }


        if ($field) {

            //format here so it has array value that can easily be used by graph
            $data = [];
            
            foreach ($sensorReading->orderBy('created_at')->get()->toArray()  as $reading) {
                $data[] = [
                    $reading['created_at'],
                    $reading['field_name'],
                ];
            }
            return $data;
        }

        return $sensorReading->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $sensorReading = SensorReading::where('sensor_id', "=", $id)->firstOrFail();

        return $sensorReading;

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
