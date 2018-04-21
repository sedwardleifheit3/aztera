<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorCommand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transmitted', 'user_id', 'sensor_id', 'acknowledged', 'rejected','sensor_command_type_id', 'value'
    ];
    
   /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'transmitted',
        'acknowledged',
        'rejected',
    ];        
}
