<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class Cities extends Controller
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
        //function for creating a new city
        try{
            $this->validate(
                $request, [
                    'name'=> 'required|unique:cities,name,NULL,id,id_province,'.$request->id_province,
                    'id_province' => 'required|numeric'
                ]
            );

            $city = new City();
            $city->name = $request->name;
            $city->id_province = $request->id_province;
            $city->save();

            return response(['msj'=>'Successfull!!!. The ID for the new City is '.$city->id],200);
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
        //Return the City on format Json
        
        try{
            $city = City::find($id);

            if ($city != null)
            {
                return response(
                    $city,
                    200
                );
            }
            else
            {
                return response(['Error:'=> 'The city whit id '.$id.' does not exist'],403);
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
                    'name'=> 'required|unique:cities,name,NULL,id,id_province,'.$request->id_province,
                    'id_province' => 'required|numeric'
                ]
            );

            $city = City::find($id);

            if($city != null)
            {
                $city->name = $request->name;
                $city->id_province = $request->id_province;

                $city->save();

                return response(
                    [
                        'msj' => 'The city had being udated successfull'
                    ], 
                    200
                );

            }else{
                return response(['Error:'=> 'The city whit id '.$id.' does not exist'],403);
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
        try{
            $city = City::find($id);

            if ($city!= null)
            {
                $city->delete();
                return response(['msj'=>'The City has been deleted'],200);
            }else
            {
                return response(['msj'=>'The City does not exist'],403);
            }

        }catch(\Exception $e)
        {
            return response(['msj'=>'it has ocurred an error'.$e->getMessage()],500);
        }
    }

    public function ShowAll()
    {
        try
        {
            $cities = City::all();

            if($cities!=null)
            {
                return response($cities, 200);
            }else
            {
                return response(['msj'=>'There is not cities'],403);
            }

        }catch(\Exception $e)
        {
            return response(['msj'=>'It has ocurred an error. Error: '.$e->getMessage()],500);
        }
    }
}
