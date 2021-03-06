<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('user-edit')){
            abort(403,"Não autorizado!");
        }

        $users = User::all();

        return view('usuarios.index', compact('users'));
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('user-create')){
            abort(403,"Não autorizado!");
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('user-delete')){
            abort(403,"Não autorizado!");
        }
    }

    public function papel($id)
    {
        if(Gate::denies('papel-delete')){
            abort(403,"Não autorizado!");
          }

        $user = User::find($id);
        $papeis = Papel::all();

        return view('usuarios.papel', compact('user', 'papeis'));
    }

    public function papelStore(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();
        $papel = Papel::find($data['papel_id']);
        $user->addPapel($papel);

        return redirect()->back();
    }

    public function papelDestroy($id, $papel_id)
    {
        $user = User::find($id);
        $papel = Papel::find($papel_id);
        $user->destroyPapel($papel);

        return redirect()->back();
    }
}

