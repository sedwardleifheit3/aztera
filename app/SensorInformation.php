<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SensorInformation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group', 'mac_address', 'dosing_rate',
        'physical_location','total_duration',
        'max_period_length','max_overflow_rate', 'message',
        'sensor_id','batch_id','state_id', 'type_id', 'dosing_rate_unit', 'duration_unit'
    ];
    
    
    /**
     * Get All sensors with sensor information
     * Get row with `group` = main
     * 
     * @return void
     */
    public static function getSensorsLatestInfo()
    {
        
        return DB::table("sensor_information AS si1")
            ->leftJoin('sensor AS s','si1.sensor_id', '=', 's.id')        
            ->select('si1.*')
            ->whereRaw('si1.group = "main" AND si1.created = (SELECT MAX(si2.created) FROM  sensor_information AS si2 WHERE si2.name =  si1.name AND si2.group = si1.group AND si2.sensor_id = si1.sensor_id )')            
            ->orderBy('si1.sensor_id', 'DESC')
            ->orderBy('si1.name', 'DESC')
            ->get();        
                   
    }

    /**
     * Get Sensor Latest info by Id
     *
     * @param [type] $sensorId
     * @return mixed
     */
    public static function getSensorLatestInfoById( $sensorId = null) 
    {
        if (empty($systemId)) return [];

        return DB::table("sensor_information AS sc1")
            ->select('sc1.*')
            ->where('sensor_id', $sensorId)
            ->whereRaw('sc1.created = (SELECT MAX(sc2.created) FROM  sensor_information AS sc2 WHERE sc2.name =  sc1.name AND sc2.group = sc1.group AND sc2.sensor_id = sc1.sensor_id )')
            ->orderBy('created', 'DESC')
            ->get();        

    }        

    /**
     * SCOPES
     * ==================================
     */

     /**
      * Get Recent Information
      *
      * @param [type] $query
      * @return mixed
      */
    public function scopeRecent($query)
    {
        $query->selectRaw('sensor_information.created AS si_created, sensor_information.name AS si_name, sensor_information.group AS si_group, sensor_information.sensor_id AS si_sensor_id')
            ->whereRaw('sensor_information.created = (SELECT MAX(si2.created) FROM  sensor_information AS si2 WHERE si2.name =  sensor_information.name  AND si2.group = sensor_information.group AND si2.sensor_id = sensor_information.sensor_id)');            
    }

    /**
     *  Relationships
     * ===================================
     */

     /**
      * has One Sensor
      */
    public function sensor()
    {
        return $this->belongsTo('App\Sensor', 'sensor_id', 'id');
    }     
    

    public function state()
    {
        return $this->hasOne('App\SensorState', 'id', 'state_id');
    }     
    


    /**
     *  STATIC functions
     * =======================================
     */

    /**
     *
     * Get dosing rate units
     * 
     * @return Array
     */ 
    public static function getDosingRateUnits()
    {
        return [
            "mg/L/day" => "mg/L/day",
            "mg/L/month" => "mg/L/month",
        ];
    }

    /**
     *
     * Get duration units
     * 
     * @return Array
     */
    public static function getDurationUnits()
    {
        return [
            'seconds' => "seconds",
            'minutes' => "minutes",
            'hours' => "hours",
            'days' => "days",
            'months' => "months",
        ];
    }
    
}
