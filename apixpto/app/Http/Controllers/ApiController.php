<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use JWTAuthException;
use App\User;
use Tymon\JWTAuth\JWTAuth;

class ApiController extends Controller
{

    private $jwtAuth;
    
    public function __construct(JwtAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
         
    }
    
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

      
            // attempt to verify the credentials and create a token for the user
            if (! $token = $this->jwtAuth->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
                return response()->json(compact('token'));
    }

    public function refresh()
    {
        $token =$this->jwtAuth->getToken();
        $token= $this->jwtAuth->refresh($token);

        return response()->json(compact('token'));
    }

    public function logout()
    {
        $token =$this->jwtAuth->getToken();
        $token= $this->jwtAuth->invalidate($token);

        return response()->json(['logout']);
    }


    public function me()
{
	

		if (! $user = $this->jwtAuth->parseToken()->authenticate()) {
			return response()->json(['error'=>'user_not_found'], 404);
		}

	
	return response()->json(compact('user'));
}
}