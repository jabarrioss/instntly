<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Ellaisys\Cognito\AwsCognitoClaim;
use Ellaisys\Cognito\Auth\AuthenticatesUsers as CognitoAuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Ellaisys\Cognito\Exceptions\NoLocalUserException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Exception;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\Log;


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
        $collection = collect($request->only(['username', 'refresh_token']));
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

        /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Support\Collection  $request
     * @param  \string  $guard (optional)
     * @param  \string  $paramUsername (optional)
     * @param  \string  $paramPassword (optional)
     * @param  \bool  $isJsonResponse (optional)
     * 
     * @return mixed
     */
    protected function attemptLogin(Collection $request, string $guard='web', string $paramUsername='email', string $paramPassword='password', bool $isJsonResponse=false)
    {
        try {
            //Get key fields
            $keyUsername = 'username';
            $keyPassword = 'refresh_token';
            $rememberMe = $request->has('remember')?$request['remember']:false;

            //Generate credentials array
            $credentials = [
                $keyUsername => $request[$paramUsername], 
                $keyPassword => $request[$paramPassword]
            ];

            //Authenticate User
            $claim = Auth::guard($guard)->attempt($credentials, $rememberMe);

        } catch (NoLocalUserException $e) {
            Log::error('AuthenticatesUsers:attemptLogin:NoLocalUserException');

            if (config('cognito.add_missing_local_user_sso')) {
                $response = $this->createLocalUser($credentials);
                
                if ($response) {
                    return $claim;
                }
            } //End if
            
            return $this->sendFailedLoginResponse($request, $e, $isJsonResponse);
        } catch (CognitoIdentityProviderException $e) {
            Log::error('AuthenticatesUsers:attemptLogin:CognitoIdentityProviderException');
            return $this->sendFailedCognitoResponse($e);
        } catch (Exception $e) {
            Log::error('AuthenticatesUsers:attemptLogin:Exception');
            return $this->sendFailedLoginResponse($request, $e, $isJsonResponse);
        } //Try-catch ends

        return $claim;
    } //Function ends
}