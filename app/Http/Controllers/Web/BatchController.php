<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Batch;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Unit;
use App\BatchInformation;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('batch.index');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::orderBy('name')->get();
        return view('batch.create', compact(['units']));                
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
            'wine_id' => 'required|string',
            'vintage' => 'required|integer',
            'varietal' => 'required|string',
            'tank' => 'required|string',
            'batch_size' => 'required|integer',
        ]);

        $nextBatchNumber = ((int)Batch::count() + 1);

        $batch = new Batch();
        $batch->name = "batch - " . $nextBatchNumber;
        $batch->description = "";
        $batch->save();

        $batchInfo = new BatchInformation();
        $batchInfo->wine_id = $input['wine_id'];
        $batchInfo->vintage = $input['vintage'];
        $batchInfo->varietal = $input['varietal'];
        $batchInfo->tank = $input['tank'];
        $batchInfo->batch_size = $input['batch_size'];
        $batchInfo->unit_id = $input['unit_id'];
        $batch->information()->save($batchInfo);


        Session::flash('flash_message', 'Batch successfully added!');
        return redirect()->route('home');        
    }

    /**
     * Display the specified resource.
     * @todo if possible get all sensors and batch information together with first sensor info in one sql statement
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selectArray = [
            'batches.id AS id',
            'batch_informations.wine_id',
            'sensor_informations.dosing_rate',
            'batch_informations.vintage',
            'batch_informations.current_o2',
            'batch_informations.varietal',
            'batch_informations.tank',
            'batch_informations.batch_size',
            'batch_informations.dose_end',
            'sensor_states.name AS sensor_state_name',
            'sensor_states.description AS sensor_state_description',
            'sensor_states.id AS sensor_state_id',
            'batches.deleted_at AS is_archived',
        ];

        //get last attached sensor only
         $batch = Batch::select(DB::raw(implode(",", $selectArray)))
            ->leftJoin('batch_informations', 'batch_informations.batch_id', '=', 'batches.id')
            ->leftJoin('batch_analyses', 'batch_analyses.batch_id', '=', 'batches.id')
            ->leftJoin('sensor_informations', 'batch_informations.batch_id', '=', 'sensor_informations.batch_id')
            ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
            ->with('analysis')
            ->findOrFail($id);

        $attachedSensors = \App\Sensor::getBatchAttachedSensorsById($id);
        $inActiveSensors = \App\Sensor::getInActiveSensors();
        $activeSensors = \App\Sensor::getActiveSensors();

        return view('batch.show', compact([
            'batch',
            'attachedSensors',
            'inActiveSensors',
            'activeSensors',
        ]));                
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $batch = Batch::select(DB::raw('batches.*, batch_informations.*, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id, batches.deleted_at AS is_archived'))
        ->leftJoin('batch_informations', 'batch_informations.batch_id', '=', 'batches.id')
        ->leftJoin('sensor_informations', 'batch_informations.batch_id', '=', 'sensor_informations.batch_id')
        ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
        ->findOrFail($id);     

        // do not allow editing of active state or batch is attached to sensor
        if (!empty($batch->sensor_state_id)) return redirect()->route('home');          

        $units = Unit::orderBy('name')->get();

        return view('batch.edit',  compact(['batch','units']));                        
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
        $input = $request->all();
				
        $validate = $request->validate([
            'wine_id' => 'required|string',
            'vintage' => 'required|integer',
            'varietal' => 'required|string',
            'tank' => 'required|string',
            'batch_size' => 'required|integer',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->information->wine_id = $input['wine_id'];
        $batch->information->vintage = $input['vintage'];
        $batch->information->varietal = $input['varietal'];
        $batch->information->tank = $input['tank'];
        $batch->information->batch_size = $input['batch_size'];
        $batch->information->unit_id = $input['unit_id'];
        $batch->push();

        Session::flash('flash_message', 'Batch successfully updated!');

        return redirect()->route('home');        
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
