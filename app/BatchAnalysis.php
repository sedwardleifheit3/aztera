<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchAnalysis extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temperature',
        'ph',
        'volatile_acidity',
        'co2_level',
        'malic_acid',
        'gluconic_acid',
        'alchohol',
        'tartaric_acid',
        'dissolved_oxygen',
        'lactic_acid',
        'conductivity',
        'assimble_amino_nitrogen',
        'total_so2',
        'ammonia_nitrogen',
        'yeast_assimble_nitrogen',
        'od280',
        'titratable_acidity',
        'acetaldehyde',
        'potassium',
        'copper',
        'free_so2',
        'sugar',
        'od280_au',
        'od280_mg_l',
        'od520',
        'od420',
        'od620',
        'glucose_fructose',
        'iron',
        'methanol',
        'turbidity',
        'total_anthocyanins',
        'free_anthocyanins',
        'total_phenolics_ipt',
        'total_tannin',
        'batch_id',
    ];
        
}
