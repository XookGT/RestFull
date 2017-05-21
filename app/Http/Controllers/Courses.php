<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class Courses extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        try
        {
            $this->validate($request,[
            'name' => 'required|unique:categories',
            'description' => 'required',
            'id_categorie' => 'numeric|required',
            'id_level' => 'numeric|required',

            ]);


            $course = new Course();
            $course->name = $request->name;
            $course->description = $request->description;
            $course->id_categorie = $request->id_categorie;
            $course->id_level = $request->id_level;
            $course->starts = 0;

            
            $course->save();



            return response(['msj'=>'Successfull!!!. The ID for the new Categorie is '.$course->id],200);

            /*
                200 ok
                500 error del servidor
                404 not found
                403 bad request
                503 bad gw
            */

        }
        catch (\Exception $e)
        {

            //perame ya se que es, es que estan en la routa de autenticacion creo, tiene q estar autenticado
            return response(['msj'=>'it has ocurred an error'.$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try
        {
            $course = Course::find($id);

        if ($course != null)
            return response($course,200);
        else
            return response(['Error:'=> 'The course whit id '.$id.' does not exist'],403);
        }
        catch (\Exception $ex)
        {
            return response(['msj'=>'It has ocurred an error. Error: '.$e->getMessage()],500);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
            try{
            $this->validate($request,[
            'name' => 'required|unique:course',
            'description'=>'required',
            'starts'=>'required|numeric',
            'id_categorie'=>'required|numeric',
            'id_level'=>'required|numeric',
            ]
            );

            $course = Course::find($id);

            if($course!=null)
            {
                $course->name = $request->name;
                $course->description = $request->description;
                $course->starts = $request->starts;
                $course->id_categorie = $request->id_categorie;
                $course->id_level = $request->id_level;
                $course->save();
                return response(['msj'=>'Sucessfull!!!'],200);
            }else
            {
                return response(['msj'=>'Course does not exists'],502);
            }
        }
        catch(\Exception $e)
        {
            return response(['msj'=>'it has ocurred an error'.$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ShowAll()
    {
        try
        {
            $courses = Course::getAll();

            if($courses!=null)
            {
                return response($courses, 200);
            }else
            {
                return response(['msj'=>'There is not courses'.$e->getMessage()],403);
            }

        }catch(\Exception $e)
        {
            return response(['msj'=>'It has ocurred an error. Error: '.$e->getMessage()],500);
        }
    }
}
