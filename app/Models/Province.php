<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Province
 *
 * @property $id
 * @property $name
 * @property $country_id
 *
 * @property Country $country
 * @property Hotel[] $hotels
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Province extends Model
{
    
    static $rules = [
		'name' => 'required',
		'country_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','country_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel', 'province_id', 'id');
    }
    

}
