<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $usersQuery = User::where('role', 'user');

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $users = $usersQuery->paginate(5);

        return view('pages.user.index', compact('users', 'search'));
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
