<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];
    
    /**
     * Relationships
     * =======================================
     */

    /**
     * 
     * Get configuration 
     *
     * @return void
     */
    public function configurations()
    {
        return $this->hasOne('App\SystemConfiguration');
    }        
    
}
