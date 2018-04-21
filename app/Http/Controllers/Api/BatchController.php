<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Batch;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $sortField = isset($params['sort']) ? $params['sort'] : 'batches.id';
        $sortField = ($sortField === 'id') ? 'batches.id' : $sortField;
        $order = isset($params['order']) ? $params['order'] : 'asc';
        
        /**
         * @todo make this 1 sensor for 1 batch only
         *  deprecate support of multiple sensor for a single batch
         */
        $batches = Batch::select(DB::raw('DISTINCT(batches.id),  batch_informations.*,  batches.deleted_at AS is_archived, sensor_states.name AS sensor_state_name,sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id'))
            ->leftJoin('batch_informations', 'batch_informations.batch_id', '=', 'batches.id')
            ->leftJoin('sensor_informations', 'batches.id', '=', 'sensor_informations.batch_id')
            ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id');
           
        if (isset($params['search'])) {
            $batches->where(function($query) use (&$params) {
                $query->where('wine_id', 'LIKE', '%' . $params['search'] . '%')
                ->orWhere('vintage', 'LIKE', '%' . $params['search'] . '%')
                ->orWhere('varietal', 'LIKE', '%' . $params['search'] . '%')
                ->orWhere('tank', 'LIKE', '%' . $params['search'] . '%');                
            });
        }

        if ((isset($params['is_archived']) && $params['is_archived'] == 1)) {
            $batches->onlyTrashed();
        }


        return $batches->orderBy($sortField, $order)->paginate($limit);
   


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
    public function show($id)
    {
        $batch = Batch::with(['analysis','information', 'informationStorage'])->findOrFail($id);
        return $batch;        
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
        $batch = Batch::findOrFail($id);
        $batch->update($request->all());
        return $batch;        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $batch = Batch::withTrashed()->findOrFail($id);

        if ($request->get('restore')) {
            $batch->restore();
        } else {
            $batch->delete();
        }
        return 204;        
    }
}
