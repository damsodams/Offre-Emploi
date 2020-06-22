<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    //
    public function entreprise()
    {
        return $this->belongsTo('App\Entreprise');
    }
}
