<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 *
 * @property $id
 * @property $name
 *
 * @property Hotel[] $hotels
 * @property Province[] $provinces
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Country extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel', 'country_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provinces()
    {
        return $this->hasMany('App\Models\Province', 'country_id', 'id');
    }
    

}
