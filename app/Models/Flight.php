<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'flights';
    protected $fillable = ['name', 'created_at'];
    public function scopeactive($query)
    {

        return $query->where('active', 1);
    }

    public function destenation(){
  return $this->hasOne(flight_destination::class);
    }
    public function booking(){
        return $this->hasMany(flight_booking::class,'flight_id');
    }



}
