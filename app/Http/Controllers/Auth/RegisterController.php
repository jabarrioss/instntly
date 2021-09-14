<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Ellaisys\Cognito\Auth\RegistersUsers;

use App\Models\Merchant;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function register(Request $request)
    {
        dump($request->all());
        // $validator = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:64|unique:users',
        //     'password' => 'sometimes|confirmed|min:6|max:64',
        // ]);


        //Create credentials object
        // $collection = collect($request->all());
        // $data = $collection->only('name', 'email', 'password'); //passing 'password' is optional.

        $collection = collect(["first_name" => "Jhonny", "email" => "descarganime2@gmail.com"]);
        //Register User in cognito
        dump($collection);
        if ($cognitoRegistered=$this->createCognitoUser($collection)) {

            //If successful, create the user in local db
            Merchant::create($collection->only('name', 'email'));
        } //End if

        dd($cognitoRegistered);
        //Redirect to view
        // return view('login');
    }
}
