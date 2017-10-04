<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response as HttpResponse;

class CategoriesControllerTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllCategoriesUnauthenticated()
    {
        // Sin auntenticar deberia dar un error 401.
        $this->call('GET', '/api/v1/categories');
        $this->assertResponseStatus(401);
    }

//    public function testGetAllCategoriesAuthenticated(){
//        $credentials = \Tymon\JWTAuth\Facades\JWTAuth::attempt(['usr_mail' => 'nicovega@adinet.com.uy', 'password' => 'maikelpg8501*']);
//
//        // as a user, I try to access the admin panels without a JWT token
//        $response = $this->call(
//            'GET',
//            '/api/v1/categories',
//            [], //parameters
//            [], //cookies
//            [], // files
//            ['HTTP_Authorization' => 'Bearer ' . $credentials], // server
//            []
//        );
//        $this->assertEquals(200, $response->status());
//
//    }

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
//        $response = $this->call('POST', 'api/v1/login', $data);
//        // I should be able to login
//        $this->assertEquals(HttpResponse::HTTP_ACCEPTED, $response->status());
//        // assert there is a TOKEN on the response
//        $content = json_decode($response->getContent());
//        $this->assertObjectHasAttribute('token', $content);
//        $this->assertNotEmpty($content->token);
//    }

    public function testCategoriesWithToken(){
        $url = '/api/v1/categories';

         // Test unauthenticated access.
        $this->get($url, $this->headers())
            ->assertResponseStatus(401);

        // Test authenticated access.
        $this->get($url, $this->headers(\App\Models\User::first()))
            ->seeJson()
            ->assertResponseOk();
    }
}
