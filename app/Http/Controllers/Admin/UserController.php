<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $allUsers = User::all();
//        $superUser = User::whereEmail('super@test.com')->first();
//        $users = User::where('id', "!=", 1)->get();
//        $users = User::whereEmail()->get();
        $users = User::where('email', "!=", 'super@test.com')->get();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('edit-users')) {
            return view('admin.users.index');
        }

        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->roles()->sync($request->input('roles'));
        if ($user->save()) {
            $request->session()->flash('success', 'User Updated Successfully');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if (Gate::denies('delete-users')) {
            return view('admin.users.index');
        }

        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');

    }
}
