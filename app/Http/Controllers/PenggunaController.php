<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUser = User::all();

        return view('admin.user.index',compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listRole = Role::all();

        return view('admin.user.create',compact('listRole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|same:password_confirmation'
        ]);

        $saveUser = new User([
            'name'      => $request->name,
            'last_name' => $request->last_name,
            'level'     => $request->level,
            'email'     => $request->email,
            'password'  => $request->password,
        ]);

        $saveUser->save();

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataUser   = User::find($id);
        $listRole   = Role::all();

        return view('admin.user.edit',compact('dataUser','listRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|',
            'password'  => 'required|same:password_confirmation'
        ]);

        $dataUser               = User::find($id);
        $dataUser->last_name    = $request->last_name;
        $dataUser->level        = $request->level;
        $dataUser->email        = $request->email;
        $dataUser->password     = $request->password;

        $dataUser->update();

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataUser = User::findOrFail($id);

        $dataUser->delete();

        return redirect('/user');
    }
}
