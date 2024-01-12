<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = \App\Models\User::paginate(10);
        $data['type_menu'] = 'users';
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data['users'] = DB::table('users')
            ->when($request->input('search'), function ($query, $condition) {
                return $query->where('name', 'like', '%' . $condition . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('users.index', $data);
    }

    public function create()
    {
        $data['type_menu'] = 'users';
        return view('users.form', $data);
    }

    public function store(Request $request)
    {
        $data['type_menu'] = 'users';
        return view('pages.undercon', $data);
    }

    public function show(string $id)
    {
        $data['type_menu'] = 'profile';
        return view('users.profile', $data);
    }

    public function edit(string $id)
    {
        $data['type_menu'] = 'profile';
        return view('users.profile', $data);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Data successfully deleted');
    }

    public function profile(Request $request, $id)
    {
        // dd('profile '.$id);
        $request->validate([
            'name'  => 'required|min:4',
            'phone' => 'required|min:5|max:15',
        ]);

        $postedData = [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'updated_at'    => date("Y-m-d H:i:s"),
        ];

        $dtUser = User::findOrFail($id);
        if ($dtUser->update($postedData)) {
            return redirect('users/'.$id)->with('success', 'Well done, Data has been updated.');
        }else{
            return redirect()->back()->with('error', 'Error during update. Please contact Administrator');
        }        

        // if($validator->fails()) {
        //     return Redirect::back()->withErrors($validator);
        // }else{

        // }
    }

    public function changePassword($id)
    {
        // dd('changePassword '.$id);
        $data['type_menu'] = 'Change Password';
        return view('users.change-password', $data);
    }  

    public function updatePassword(Request $request, $id)
    {
        // dd('updatePassword '.$id);
        $request->validate([
            'current_password'  => 'required|string|min:6',
            'password'          => 'required|confirmed|different:current_password|min:6',
        ]);

        // if (!Hash::check($request->password, Auth::user()->password)) 
        // {
        //     return back()->with('error', "Current Password is Invalid");
        // }

        $postedData = [
            'password' => Hash::make($request->password),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $dtUser = User::findOrFail($id);
        if ($dtUser->update($postedData)) {
            return redirect('users/'.$id)->with('success', 'Well done, Password has been changed.');
        }else{
            return redirect()->back()->with('error', 'Error during change password. Please contact Administrator');
        }
    
    }     
}
