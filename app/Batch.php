<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use SoftDeletes;

    /*
    const FIELD_INFO_MAP = [
        'wined_id' => 'Wine ID',        
        'vintage' => 'Vintage',        
        'varietal' => 'Varietal',        
        'batch_size'     => 'Batch Size',        
        'current_o2'     => 'Current O2',        
    ];
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'description'
    ];
    

    /**
     * Relationships
     * ======================================
     */
    
    
     /**
      * Get Analysis
      *
      * @return void
      */
    public function analysis()
    {
        return $this->hasOne('App\BatchAnalysis');
    }    

    /**
     * Get Information
     *
     * @return void
     */
    public function information()
    {
        return $this->hasOne('App\BatchInformation');
    }    
    
    /**
     * 
     * Get Information Storage
     *
     * @return void
     */
    public function informationStorage()
    {
        return $this->hasMany('App\BatchStorage');
    }    

    /**
     * Static functions
     * ==================================
     */
   /**
     * Get InActive Sensors, 
     * This means, it is not attached to a batch, which is batch_id = NULL
     * @todo test script
     * @return mixed
     */
    public static function getInActiveSensors()
    {
		return Cache::remember('batch_analyses', 60, function() {

            /*
            return  \App\SensorInformation::select(DB::raw('sensor_types.name AS sensor_type_name, sensor_states.name AS sensor_state_name, sensor_states.description AS sensor_state_description, sensor_states.id AS sensor_state_id,sensor_informations.*'))
            ->leftJoin('sensor_states', 'sensor_informations.state_id', '=', 'sensor_states.id')
            ->leftJoin('sensor_types', 'sensor_informations.type_id', '=', 'sensor_types.id')
            ->whereNull('batch_id')
            ->get()->toArray();            
            */
        });        
    }    
    
}
