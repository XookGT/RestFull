<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;

class Categories extends Controller
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

            ]);


            $categorie = new Categorie();
            $categorie->name = $request->name;
            $categorie->save();



            return response(['msj'=>'Successfull!!!. The ID for the new Categorie is '.$categorie->id],200);

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
            $categorie = Categorie::find($id);

            if($categorie!=null)
            {
                return response($categorie,200);
            }else
            {
                return response(['Msj'=>'The categorie does not exist'],404);
            }
        }catch(\Exception $ex)
        {
            return response(['Error'=>'Server responses whit error: '.$ex->getMessage()],404);
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
            'name' => 'required|unique:categories',]
            );

            $categorie = Categorie::find($id);

            if($categorie!=null)
            {
                $categorie->name = $request->name;
                $categorie->save();
                return response(['msj'=>'Sucessfull!!!'],200);
            }else
            {
                return response(['msj'=>'Categories does not exists'],502);
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
            $categorie = Categorie::find($id);
             if($categorie!=null)
            {
                $categorie->delete();
                return response(['msj'=>'Sucessfull!!!'],200);
            }else
            {
                return response(['msj'=>'Categorie does not exists. '],403);
            }

        }catch(\Exception $e)
        {
            return response(['msj'=>'it has ocurred an error'.$e->getMessage()],500);
        }
    }

    public function SearchByName($id)
    {
        $name = $id;

        try{
            $categorie = Categorie::where('name',$name)->first();
            if($categorie!=null)
                return response($categorie,200);
            else
                return response(['msj'=>'Categorie do not exist on Xook'],401);
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
            $categories = Categorie::all();

            if($categories!=null)
                return response($categories,200);
            else
                return response(['msj'=>'Categories are clean'],401);

        }
        catch(\Exceptio $e)
        {
            return response(['msj'=>'Error'],500);
        }
        
    }
}
