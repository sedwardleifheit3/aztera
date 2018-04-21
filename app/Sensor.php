<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Sensor extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desription', 'is_active'
    ];
    
    public function informations()
    {
        return $this->hasOne('App\SensorInformation');
    }     

    
    /**
     * Get Active Sensors, 
     * This means, it is  attached to a batch, which is batch_id <> NULL
     * @todo test script
     *
     * @return mixed
     */
    public static function getActiveSensors()
    {		
		//get from memcached
		return Cache::remember('active_sensor_list', 60, function() {
            return  \App\SensorInformation::select(DB::raw('sensor_types.name AS sensor_type_name, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id,sensor_informations.*'))
            ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
            ->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
            ->whereNotNull('batch_id')
            ->get()->toArray();        
        });		        
    }

    /**
     * Get InActive Sensors, 
     * This means, it is not attached to a batch, which is batch_id = NULL
     * @todo test script
     * @return mixed
     */
    public static function getInActiveSensors()
    {
		return Cache::remember('in_active_sensor_list', 60, function() {
            return  \App\SensorInformation::select(DB::raw('sensor_types.name AS sensor_type_name, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id,sensor_informations.*'))
            ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
            ->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
            ->whereNull('batch_id')
            ->get()->toArray();            
        });        
    }

    /**
     * 
     * Get Batch Attached Sensor
     *
     * @param integer $id
     * @return mixed
     */
    public static function getBatchAttachedSensorsById( $id = 0, $cached = false)
    {
        if(!$id) return [];

        if ($cached) {
            return Cache::remember('attached_sensor_list', 60, function() use (&$id) {
                return \App\SensorInformation::select(DB::raw('sensor_types.name AS sensor_type_name, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id,sensor_informations.*'))
                ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
                ->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
                ->where('batch_id','=',$id)
                ->get()->toArray();          
            });            
        }

        return \App\SensorInformation::select(DB::raw('sensor_types.name AS sensor_type_name, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id,sensor_informations.*'))
        ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
        ->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
        ->where('batch_id','=',$id)
        ->get()->toArray();         
    }    
}
