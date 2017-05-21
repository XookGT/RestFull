<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
class Levels extends Controller
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
            'name' => 'required|unique:levels',

            ]);

            $level = new Level();
            $level->name = $request->name;
            
            $level->save();

            return response(['msj'=>'Successfull!!!. The ID for the new Level is '.$level->id],200);

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
            return response(['msj'=>'It has ocurred an error'.$e->getMessage()],500);
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
            $level = Level::find($id);

            if($level!=null)
            {
                return response($level,200);
            }else
            {
                return response(['Msj'=>'The level does not exist'],404);
            }
        }catch(\Exception $ex)
        {
            return response(['Error'=>'Server responses whit error: '.$ex->getMessage()],500);
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
            'name' => 'required|unique:levels',]
            );

            $level = Level::find($id);

            if($level!=null)
            {
                $level->name = $request->name;
                $level->save();
                return response(['msj'=>'Sucessfull!!!'],200);
            }else
            {
                return response(['msj'=>'Level does not exists'],502);
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
        try
        {
            $level = Level::find($id);
             if($level!=null)
            {
                $level->delete();
                return response(['msj'=>'Sucessfull!!!'],200);
            }else
            {
                return response(['msj'=>'Level does not exists. '],403);
            }

        }catch(\Exception $e)
        {
            return response(['Error'=>'it has ocurred an error'.$e->getMessage()],500);
        }
    }

    public function SearchByName($id)
    {
        $name = $id;

        try{
            $level = Level::where('name',$name)->first();
            if($level!=null)
                return response($level,200);
            else
                return response(['msj'=>'Level do not exist on Xook'],401);
        }
        catch(\Exceptio $e)
        {
            return response(['msj'=>'Error'],500);
        }

    }

    public function ShowAll()
    {
        try
        {
            $level = Level::all();

            if($level!=null)
                return response($level,200);
            else
                return response(['msj'=>'Level are clean'],401);

        }
        catch(\Exceptio $e)
        {
            return response(['msj'=>'Error'],500);
        }
        
    }
}
