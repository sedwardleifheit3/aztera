<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SystemConfiguration extends Model
{
    /*
    const FIELD_MAP = [
        'recording_interval' => 'Recording Interval',
        'language' => 'Language',
        'dosing_point_subnet_network' => 'Dosing Point Subnet Mask',
        'dosing_point_default_gateway' => 'Dosing Point Default Gateway',
    ];
    */
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'system_id',
        'group',
        'dosing_point_gateway',
        'dosing_point_subnet_mask',
        'recording_interval',
        'language',
    ];
     
    
    /**
     *
     *  Get Latest System Configurations
     *  @since it is being saved this way, we have no other way but to get the latest by date
     *  @todo find out why the data is being saved in a generic manner, instead of putting the necessary data to db fields
     * 
     * @param [type] $systemId
     * @return void
     */
    public static function getSystemLatestConfigById( $systemId = null) 
    {
        if (empty($systemId)) return [];

        return DB::table("system_configuration AS sc1")
            ->select('sc1.*')
            ->where('system_id', $systemId)
            ->whereRaw('sc1.created = (SELECT MAX(sc2.created) FROM  system_configuration AS sc2 WHERE sc2.name =  sc1.name AND sc2.group = sc1.group AND sc2.system_id = sc1.system_id )')
            ->orderBy('created', 'DESC')
            ->get();        

    }
    
    /**
     * 
     * Relationships
     * ====================================================
     */
    /**
     * 
     * Get Information Storage
     *
     * @return void
     */
    public function getSystem()
    {
        return $this->hasOne('App\System');
    }           

    /**
     *
     * Scope for latest recording interval field
     * @note it expects that this field exist
     * 
     * @param [type] $query
     * @return mixed
     */
    public function scopeLatestRecordingInterval($query)
    {
        return $query->where('name','Recording Interval')->orderBy('created', 'DESC')->first();

    }

    /**
     * Scope latest Language
     *
     * @param [type] $query
     * @return void
     */
    public  function scopeLatestLanguage($query)
    {
        return $query->where('name','Language')->orderBy('created', 'DESC')->first();        
    }
}
