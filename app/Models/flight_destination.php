<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class flight_destination extends Model
{
  protected $table = 'flight_destination';
 protected $fillable=['destination','created_at','updated_at','flight_id'];
public function flight()

    {
        return $this->belongsTo(Flight::class);
    }

}
