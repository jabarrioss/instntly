<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Ellaisys\Cognito\AwsCognitoClaim;
use Ellaisys\Cognito\Auth\AuthenticatesUsers as CognitoAuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use CognitoAuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Authenticate User
     * 
     * @throws \HttpException
     * 
     * @return mixed
     */
    public function login(Request $request)
    {
        //Convert request to collection
        $collection = collect($request->only(['email', 'password']));
        //Authenticate with Cognito Package Trait (with 'web' as the auth guard)
        if ($response = $this->attemptLogin($collection, 'web')) {
            if ($response===true) {
                dump("Finally");
                return redirect(route('home'))->with('success', true);
            } else if ($response===false) {
                // If the login attempt was unsuccessful you may increment the number of attempts
                // to login and redirect the user back to the login form. Of course, when this
                // user surpasses their maximum number of attempts they will get locked out.
                //
                //$this->incrementLoginAttempts($request);
                //
                $this->sendFailedLoginResponse($collection, null);
            } else {
                dump("Login failed. dont know why");
                dump($collection);
                dump($response);
                return $response;
            } //End if
        } //End if
        return back()->with("error", 'Failed Login');
    } //Function ends

    public function apiLogin(Request $request)
    {
        //Convert request to collection
        $collection = collect($request->all());

        //Authenticate with Cognito Package Trait (with 'api' as the auth guard)
        if ($claim = $this->attemptLogin($collection, 'api', 'username', 'refresh_token', true)) {
            if ($claim instanceof AwsCognitoClaim) {
                return $claim->getData();
            } else {
                return response()->json(['status' => 'error', 'message' => $claim], 400);
            } //End if
        } //End if
    }
}