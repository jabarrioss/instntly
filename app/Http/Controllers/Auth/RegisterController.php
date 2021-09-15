<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Ellaisys\Cognito\Auth\RegistersUsers;

use App\Models\Merchant;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // $validator = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:64|unique:users',
        //     'password' => 'sometimes|confirmed|min:6|max:64',
        // ]);


        //Create credentials object
        $collection = collect($request->all());
        $data = $collection->only('first_name', 'email');

        //Register User in cognito
        if ($cognitoRegistered=$this->createCognitoUser($data)) {
            //If successful, create the user in local db
            $merchant = Merchant::create($collection->only('first_name', 'email')->toArray());
        } //End if
        //Redirect to view
        return redirect('login');
        // return view('login');
    }
}
