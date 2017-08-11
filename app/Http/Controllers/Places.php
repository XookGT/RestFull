<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

class Places extends Controller
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
        //function for creating a new place
        try{
            $this->validate(
                $request, [
                    'name'=> 'required|unique:places,name,NULL,id,id_city,'.$request->id_city,
                    'description' => 'required',
                    'id_city' => 'required|numeric'
                ]
            );

            $place = new Place();
            $place->name = $request->name;
            $place->description = $request->description;
            $place->id_city = $request->id_city;
            $place->save();

            return response(['msj'=>'Successfull!!!. The ID for the new place is '.$place->id],200);
        }catch(\Exception $e)
        {
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
        //Return the place on format Json
        
        try{
            $place = Place::find($id);

            if ($place != null)
            {
                return response(
                    $place,
                    200
                );
            }
            else
            {
                return response(['Error:'=> 'The place whit id '.$id.' does not exist'],403);
            }
        }catch(\Execption $e)
        {
            return response(['msj'=>'it has ocurred an error'.$e->getMessage()],500);
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
            $this->validate(
                $request,
                [
                    'name'=> 'required|unique:places,name,NULL,id,id_city,'.$request->id_city,
                    'description' => 'required',
                    'id_city' => 'required|numeric'
                ]
            );

            $place = Place::find($id);

            if($place != null)
            {
                $place->name = $request->name;
                $place->description = $request->description;
                $place->id_city = $request->id_city;

                $place->save();

                return response(
                    [
                        'msj' => 'The place had being udated successfull'
                    ], 
                    200
                );

            }else{
                return response(['Error:'=> 'The place whit id '.$id.' does not exist'],403);
            }

        }catch(\Exception$e)
        {
            return response(
                [
                    'msj'=>'it has ocurred an error'.$e->getMessage()
                ], 
                500
            );
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
}
