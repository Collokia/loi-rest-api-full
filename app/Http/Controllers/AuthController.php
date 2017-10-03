<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Exception;
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

    public function __construct(JWTAuth $jwt, Handler $handler)
    {
        $this->jwt = $jwt;
        $this->handler = $handler;
    }


    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        if ( $request->isJson() ) {
            $this->validate($request, [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            try {
                $password = $request->input('password');
                $email = $request->input('email');
                $password_md5 = md5($password);
                $credentials = $this->getCredentials($request);

                $user = User::where('usr_mail', '=', $email)
                    ->where('usr_pass', '=', $password_md5)
                    ->first();

                if (!$user) {
                    return $this->handler->render($request, Exception::$e);
                } else {
                    $token = $user->password ? $this->jwt->attempt($credentials) : $this->jwt->fromUser($user);
                }

            } catch (TokenExpiredException $e) {

                return $this->handler->render($request, $e);

            } catch (TokenInvalidException $e) {

                return $this->handler->render($request, $e);

            } catch (JWTException $e) {

                return $this->handler->render($request, $e);

            }

            return response()->json(compact('token'));
        }

        return $this->handler->error('Unauthorized', Response::HTTP_UNAUTHORIZED);


    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return ['usr_mail' => $request->input('email'), 'password' => $request->input('password')];
    }

}