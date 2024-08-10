<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('pages.user.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if($user){
            notify()->success(message: 'User Updated Successfully');
            return redirect()->route('users.index');
        } else {
            notify()->error(message: 'User Update Failed');
            return redirect()->route('users.index');
        }
    }
}
