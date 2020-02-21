<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    use ProcessResponseTrait;

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $http = new \GuzzleHttp\Client;

            $response = $http->post(env('APP_URL').'/oauth/token', [
                'form_params' => [
                    'grant_type' => Config::get('settings.passport.grant_type'),
                    'client_id' => Config::get('settings.passport.client_id'),
                    'client_secret' => Config::get('settings.passport.client_secret'),
                    'scope' => Config::get('settings.passport.scope'),
                    'username' => $request->email,
                    'password' => $request->password,
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        }
        catch (\GuzzleHttp\Exception\BadResponseException $e)
        {
            return $this->processResponse($e->getCode(),'error','Something went wrong');
        }



    }

    public function processLogin()
    {

    }

    public function logout()
    {
        $this->revokeToken(Auth::user()->tokens);

        return $this->processResponse(null,'success','Logged out successfully!');
    }

    public function register(Request $request)
    {
        return 'register';
    }

    //revoke tokens
    public function revokeToken($tokens)
    {
        foreach($tokens as $token)
        {
            $token->revoke();
        }
    }
}
