<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactModel extends Model
{
    public $table='contacts';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
