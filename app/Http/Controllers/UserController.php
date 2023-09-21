<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::whereNot('id', $user->id)->get();

        return view('user.index', [
            'users' => $users
        ]);
    }


    public function revokeRole()
    {
        $user = User::where('id', request()->get('id'))->first();
        $role = request()->get('role');
        $user->removeRole($role);
        return redirect()->back()->with(['status' => 'Role remove success']);

    }


    public function assignRole(Request $request)
    {
        $user = User::where('id', request()->get('id'))->first();
        $role = request()->get('role');
        $user->assignRole($role);
        return redirect()->back()->with(['status' => 'Role assign success']);
    }

}
