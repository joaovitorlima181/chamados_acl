<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Papel::all();

        return view('papel.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        view('papel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->nome && $request->nome != "Admin") {
            Papel::create($request->all());

            return redirect()->route('papeis.index');
        }

        return redirect()->back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Papel::find($id)->nome == "Admin") {
            return redirect()->route('papeis.index');
        }

        $registro = Papel::find($id);

        return view('papel.editar', compact('registro'));
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
        if (Papel::find($id)->nome == "Admin") {
            return redirect()->route('papeis.index');
        }

        if ($request->nome && $request->nome != "Admin") {
            Papel::find($id)->update($request->all());
        }

        return redirect()->route('papeis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Papel::find($id)->nome == "Admin") {
            return redirect()->route('papeis.index');
        }

        Papel::find($id)->delete();
        return redirect()->route('papeis.index');
    }
}
