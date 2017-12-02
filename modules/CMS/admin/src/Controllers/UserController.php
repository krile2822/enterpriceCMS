<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;
use CMS\admin\EmailVerification;
use CMS\admin\User;

class UserController extends Controller
{

/*******************************************************************************
	 						This function used on the users.blade.php
/******************************************************************************/

	public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $confirmation_code = str_random(30);

        $user = User::create([
           'name' => $request['name'],
           'email' => $request['email'],
           'confirmation_code' => $confirmation_code,
           'password' => bcrypt($request['password'])

        ]);

        \Mail::to($user)->send(new EmailVerification($user, $confirmation_code));

        return response()->json(['message' => "OK"]);
    }

    public function update(Request $request) {

		$user = User::findOrFail($request['id']);
		if ($user) {
			$user->email = $request['new_email'];
			$user->name = $request['new_name'];
			$user->save();

			return response()->json([
				'message' => "OK",
				"new_name" => $request['new_name'],
				"new_email" => $request['new_email'],
				"id" => $user->id
			]);
		} else {
			return response()->json(['message' => "There are no user with this ID"]);
		}
    }

    public function destroy(Request $request) {

    	$id = $request['id'];
    	$user = User::findOrFail($id);
    	if ($user) {
    		$user->delete();
    		return response()->json(['message' => 'OK', 'id' => $id]);
    	} else {
    		return response()->json(['message' => 'Failed to delete']);
    	}

    }
}
