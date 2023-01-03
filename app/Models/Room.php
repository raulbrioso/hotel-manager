<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * Class Room
 *
 * @property $id
 * @property $name
 * @property $max_guest
 * @property $floor
 * @property $status
 * @property $hotel_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Hotel $hotel
 * @property RoomUser[] $roomUsers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Room extends Model
{
    
    static $rules = [
		'name' => 'required',
		'max_guest' => 'required',
		'floor' => 'required',
		//'status' => 'required',
		'hotel_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','max_guest','floor','status','hotel_id'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => '0',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne('App\Models\Hotel', 'id', 'hotel_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'room_user','room_id','user_id') ->withPivot('checkin','checkout');;
    }
    

}
