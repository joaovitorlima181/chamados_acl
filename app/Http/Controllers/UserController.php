<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function papel($id)
    {
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

