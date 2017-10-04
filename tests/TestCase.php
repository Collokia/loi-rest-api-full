<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost:8000';


    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function headers($user = null)
    {
        $headers = ['Accept' => 'application/json'];

        if (!is_null($user)) {
            $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
            $headers['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }
}
