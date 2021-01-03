<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Models\Permissao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('user-view')){
            abort(403,"Não autorizado!");
        }

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
        if(Gate::denies('user-create')){
            abort(403,"Não autorizado!");
        }

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
        if(Gate::denies('usuario-create')){
            abort(403,"Não autorizado!");
        }

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
        if(Gate::denies('user-edit')){
            abort(403,"Não autorizado!");
        }

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
        if(Gate::denies('user-edit')){
            abort(403,"Não autorizado!");
        }

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
        if(Gate::denies('user-destroy')){
            abort(403,"Não autorizado!");
        }

        if (Papel::find($id)->nome == "Admin") {
            return redirect()->route('papeis.index');
        }

        Papel::find($id)->delete();
        return redirect()->route('papeis.index');
    }

    public function permissao($id)
    {
        $papel = Papel::find($id);
        $permissoes = Permissao::all();

        return view('papel.permissao', compact('papel', 'permissoes'));
    }

    public function permissaoStore(Request $request, $id)
    {
        $papel = Papel::find($id);
        $data = $request->all();
        $permissao = Permissao::find($data['permissao_id']);
        $papel->addPermissao($permissao);

        return redirect()->back();
    }

    public function permissaoDestroy($id, $permissao_id)
    {
        $papel = Papel::find($id);
        $permissao = Permissao::find($permissao_id);
        $papel->destroyPermissao($permissao);

        return redirect()->back();
    }
}
