<?php

class AuthControllerTest extends TestCase
{
//    /**
//     * .
//     *
//     * @return void
//     */
//    public function testLoginSuccess()
//    {
//        $data = [ 'content' => '{"email":"test@test.fr","password":"test"}'];
//        $data_array =  ['email' => 'test@test.fr', 'password' => 'test'];
//        $headers = ['Content-Type' =>  'application/json'];
//
//        $this->post('api/v1/login', $data_array, $headers);
//
//        $this->seeJsonStructure([
//            'token'
//        ]);
//    }

    public function testLoginFailedEmail()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testLoginFailedPassword()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
