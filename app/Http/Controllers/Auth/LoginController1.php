<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => 'logout']);
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! Auth::attempt($credentials)) {
                return response()->json([
                    'errors' => [
                        'status'    => '401',
                        'source'    => [
                            'url' => $request->url(),
                            'method' => $request->getMethod()
                        ],
                        'title'     => 'Invalid credentials',
                        'detail'    => 'Invalid credentials'
                    ]
                ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'errors' => [
                    'status'    => '500',
                    'source'    => [
                        'url' => $request->url(),
                        'method' => $request->getMethod()
                    ],
                    'title'     => 'Internal error',
                    'detail'    => $e
                ]
            ], 500);
        }

        $token = $this->getToken(Auth::user());

        $this->saveToken($token);

        // all good so return the token
        return response()->json([
            'data' => compact('token')
        ]);
    }

    /**
     * @api {get} /logout Logout
     * @apiName Logout
     * @apiGroup Auth
     * @apiSuccess {json} message Mensaje de confirmacion
     * @apiHeaderExample {json} Header-Example:
     *  {
     *      "Authorization": "Bearer eyJ0eXAiOiIUzI1NiJ9.eyJzdWIiOjEsINjgxMDRiYTk1OCJ9.uVM3-eB3mEXkSibZ8g",
     *      "Content-Type": application/json
     *  }
     * @apiVersion 1.0.0
     */
    public function logout()
    {
        $user = Auth::user();

        $user->api_token = null;
        $user->save();

        return response()->json([
            'data' => [
                'message' => 'Logout success.'
            ]
        ]);
    }

    private function getToken($user)
    {
        $customClaims = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ];

        $payload = JWTFactory::make($customClaims);

        $token = JWTAuth::encode($payload);

        return $token->get();
    }

    private function saveToken($token)
    {
        $user = Auth::user();

        $user->api_token = $token;
        $user->save();
    }
}
