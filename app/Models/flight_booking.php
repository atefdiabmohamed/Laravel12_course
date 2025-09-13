<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class flight_booking extends Model
{
    protected $table = 'flight_booking';
    protected $fillable = ['traveler_name', 'created_at', 'updated_at', 'flight_id'];
 public function flight()

    {
        return $this->belongsTo(Flight::class);
    }
 public function users()

    {

        return $this->belongsToMany(User::class);

    }


}
