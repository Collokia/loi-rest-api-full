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

    /**
     * User may want to login.
     * This route should be free for all unauthenticated users.
     * User should receive an JWT token
     */
//    public function testLoginSuccesfull()
//    {
//        // as a user, I wrongly type my email and password
//        $data = ['email' => 'admin@app.com', 'password' => 'secret'];
//        // and I submit it to the login api
//        $response = $this->call('POST', 'login', $data);
//        // I should be able to login
//        $this->assertEquals(HttpResponse::HTTP_ACCEPTED, $response->status());
//        // assert there is a TOKEN on the response
//        $content = json_decode($response->getContent());
//        $this->assertObjectHasAttribute('token', $content);
//        $this->assertNotEmpty($content->token);
//    }

}
