<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class Countries extends Controller
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
            'name' => 'required|unique:countries',
            ]);


            $country = new Country();
            $country->name = $request->name;
            $country->save();



            return response(['msj'=>'Successfull!!!. The ID for the new Country is '.$country->id],200);

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
        try
        {
            $country = Country::find($id);

            if ($country != null)
            {
                return response($country,200);
            }else
            {
                return response(['msj'=>'The course does not exist'],403);
            }
        }
        catch (\Exception $e)
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
            'name' => 'required|unique:countries',
            ]);

            $country = Country::find($id);

            if ($country != null)
            {
                $country->name = $request->name;
                return response(['msj'=>'The country has ben updated'],200);
            }else
            {
                return response(['Error'=>'The country does not exist'],403);
            }
        }
        catch (\Exception $e)
        {
            return response(['Error'=>'it has ocurred an error'.$e->getMessage()],500);
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
