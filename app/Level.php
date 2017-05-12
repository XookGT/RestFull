<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //Niveles de Cursos, cada nivel pertenece a una categoria

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name',
    ];
}
