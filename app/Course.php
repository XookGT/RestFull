<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    //Cada Curso pertenece a un nivel y una categoria

    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name',
            'description',
            'starts',
            'id_categorie',
            'id_level',
    ];

    static public function getAll()
    {

        $course = DB::table('courses')
            ->join('categories', 'categories.id', '=', 'courses.id_categorie')
            ->join('levels', 'levels.id', '=', 'courses.id_level')
            ->select('courses.*', 'categories.name as categorie','levels.name as level')
            ->get();
        return $course;
    }
}
