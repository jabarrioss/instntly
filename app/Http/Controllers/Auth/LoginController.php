<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Ellaisys\Cognito\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
}