<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->paginate(10);
        return view('admin.pages.index',compact('users'));
    }

    public function add_user(AddUserRequest $request)
    {
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
        ]);

        if($user)
        {
            return json_encode([
                'success' => true,
                'message' => 'User added successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong please try again',
            ]);
        }
    }
    public function edit_user_view($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.pages.users.edit',compact('user'));
    }

    public function edit(EditUserRequest $request)
    {
        $user = User::where('id',$request->user_id)->update([
            'name' => $request->user_name,
            'email' => $request->email,
        ]);
        if($user)
        {
            return json_encode([
                'success' => true,
                'message' => 'User updated successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong please try again',
            ]);
        }
    }

    public function delete_user(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if($user)
        {
            User::where('id',$request->id)->delete();
        }
        return response()->json([
            'success' => true,
            'message' => 'User Record Deleted',
        ]);
    }

}
