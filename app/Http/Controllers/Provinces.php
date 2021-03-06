<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
class Provinces extends Controller
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
            //unique:table,column,except,idColumn
            $this->validate(
                $request,
                [
                    'name' => 'required|unique:provinces,name,NULL,id,id_country,'.$request->id_country,
                    'id_country' => 'required|numeric'
            ]);


            $province = new Province();
            $province->name = $request->name;
            $province->id_country = $request->id_country;
            $province->save();



            return response(['msj'=>'Successfull!!!. The ID for the new Province is '.$province->id],200);

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
        try{
            $province = Province::find($id);

            if ($province!= null)
            {
                return response([$province],200);
            }else
            {
                return response(['msj'=>'The Province does not exist'],403);
            }

        }catch(\Exception $e)
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
                try
        {
            $this->validate($request,[
            'name' => 'unique:provinces,name,NULL,id,id_country,'.$request->id_country
            ]);


            $province = Province::find($id);

            if ($province !=null)
            {
                $province->name = $request->name;
                $province->id_country = $request->id_country;
                $province->save();
                return response(['msj'=>'Successfull!!!. The province has been update '.$province->id],200);
            }
            else
            {
                return response(['msj'=>'The Provinces does not exist'],403);
            }
            

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
        try{
            $province = Province::find($id);

            if ($province!= null)
            {
                $province->delete();
                return response(['msj'=>'The Province has been deleted'],200);
            }else
            {
                return response(['msj'=>'The Province does not exist'],403);
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
            $provinces = Province::all();

            if($provinces!=null)
            {
                return response($provinces, 200);
            }else
            {
                return response(['msj'=>'There is not provinces'],403);
            }

        }catch(\Exception $e)
        {
            return response(['msj'=>'It has ocurred an error. Error: '.$e->getMessage()],500);
        }
    }
}
