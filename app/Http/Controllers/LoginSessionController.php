<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;

class LoginSessionController extends Controller
{
    public function store()
    {
    	$phonenumber = request('phonenumber');
		logger($phonenumber);
		$user = User::firstOrCreate([
            'name' => $phonenumber,
            'phone' => $phonenumber
        ]);
        $token = $user->createToken(request('device_name'))->plainTextToken;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'avatar' => $user->avatar,
            'token' =>  $token,
            'credit' =>  $user->fubi
        ];
    }

}
