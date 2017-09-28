<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('usr_mail', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = $this->jwt->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function loginWithJwt(Request $request)
    {
//        $pass = app('hash')->make('maikelpg8501*');
//        dd($pass);

//        $pasB = password_hash('d01a0e1cb136e7f69c148690f88ffdff', PASSWORD_BCRYPT);
//        dd($pasB);

        $this->validate($request, [
            'usr_mail'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
//            $password = md5($request->input('password'));
//            $email = $request->input('usr_mail');
            if (! $token = $this->jwt->attempt($request->only('usr_mail', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], $e->getStatusCode());
        }

        return response()->json(compact('token'));
    }

    public function loginWithAuth(Request $request){
        $token = app('auth')->attempt($request->only('usr_mail', 'password'));

        return response()->json(compact('token'));
    }

    public function getFirstUserToken(Request $request){
        $user = User::first();
        $token = $this->jwt->fromUser($user);
        return response()->json(['token' => $token], 200);
    }

    function getByDefaultToken(){
        try{
            $token = $this->jwt->attempt(['usr_mail' => 'nicovega@adinet.com.uy', 'password' => 'maikelpg8501*']);
            return response()->json(['token' => $token], 200);
        } catch (JWTException $e){
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

    }
}