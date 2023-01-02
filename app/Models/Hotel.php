<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hotel
 *
 * @property $id
 * @property $name
 * @property $street
 * @property $postal_code
 * @property $city
 * @property $country_id
 * @property $province_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Country $country
 * @property Province $province
 * @property Room[] $rooms
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Hotel extends Model
{
    
    static $rules = [
		'name' => 'required',
		'street' => 'required',
		'postal_code' => 'required',
		'city' => 'required',
		'country_id' => 'required',
		'province_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','street','postal_code','city','country_id','province_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function province()
    {
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany('App\Models\Room', 'hotel_id', 'id');
    }
    

}
